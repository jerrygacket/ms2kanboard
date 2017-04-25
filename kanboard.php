<?php
/** @var modX $modx */

require MODX_CORE_PATH.'components/guzzle/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

//***************************************************
$kanboardclient = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://yoursite.yourdomen/kanboard/',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);
//***************************************************

//***************************************************
//see kanboard api documentation for more detail about users and access keys
//you must replace $kanboardAccessKey with your key
$kanboardAccessKey = '4620d453e52d23a33cead8996fdfe2f7d59a7b73ba77456874098509d4d3';
$kanboardName="jsonrpc";
//***************************************************

//project id and column id must be replaced with your data
$project_id = 45;
$zero_column_id = 789;

switch ($modx->event->name) {
	case "msOnCreateOrder":
		//get order id
		$order_id = "{$msOrder->num}";
		//get customer contacts
		$contacts = $modx->getObject('msOrderAddress', array('id'=> $msOrder->address));
		//get products in shoping cart
        	$_products = $msOrder->getMany('Products');

		$i = 0;
		$products = '';
		foreach($_products as $product) {
			$i++;
			//make strings for every product for task description
			$products .= "{$i}. {$product->name} ({$product->count} шт.) {$product->price} руб./шт. Всего {$product->cost} рублей";
			$products .= "\n";
		}

		//make description for task with markdown language
		$description .= "Новый заказ #{$msOrder->num} на сумму {$msOrder->cost} р.\n\n";
		$description .= "Товары:\n";
		$description .= "{$products}\n";
		$description .= "Доставка по адресу:\n";
		$description .= "* Получатель: {$contacts->receiver}\n";
		$description .= "* Индекс: {$contacts->index}\n";
		$description .= "* Область: {$contacts->region}\n";
		$description .= "* Город: {$contacts->city}\n";
		$description .= "* Улица: {$contacts->street}\n";
		$description .= "* Дом: {$contacts->building}\n";
		$description .= "* Квартира: {$contacts->room}\n";
		$description .= "* Комментарий: {$contacts->comment}\n";
		$description .= "\n";

			//create task in kanboard
		$kanboardresponse = $kanboardclient->request('POST', 'jsonrpc.php', [
			'auth' => [$kanboardName, $kanboardAccessKey],
			'json' => [
				'jsonrpc' => '2.0',
				'method'=>'createTask',
				'id'=>'1',
				'params'=>[
					'creator_id' => 30,
					'description' => $description,
					'title' => 'Заказ #'.$order_id,
					'project_id' => $project_id,
				]
			]
		]);
		break;
	case "msOnChangeOrderStatus":
		//get order id
		$order_id = $order->get('num');
		//set column id in kanboard project in accordance with order status
		//must be done with case select or for search column id in project with keywords
		//or modx_lexicon if it will be a modx component
		$column_id = $zero_column_id + $status;
		//get payment info
		$_paymentinfo = json_decode("{$order->properties}",true);
		//if payment info available then make strings for task deskription 
		if (!empty($_paymentinfo['payment'])){
		    $paymentinfo = "Информация о платеже:\n";
		    foreach($_paymentinfo['payment'] as $key => $value) {
			$paymentinfo .= "* $key: $value";
			$paymentinfo .= "\n";
		    }
		}

		//search task in project. query is order id.
		$kanboardresponse = $kanboardclient->request('POST', 'jsonrpc.php', [
			'auth' => [$kanboardName, $kanboardAccessKey],
			'json' => [
				'jsonrpc' => '2.0',
				'method'=>'searchTasks',
				'id'=>'1',
				'params'=>[
					'project_id'=>$project_id,
					'query'=>$order_id
				]
			]
		]);
		$kanboardbody = $kanboardresponse->getBody();
		$kanboardjsonResponse=json_decode($kanboardbody,true);
		
		//if no error on json request and task with title $order_id exists
		if(empty($kanboardjsonResponse['error'])) {
		    if(!empty($kanboardjsonResponse['result'])) {
			$task_id = $kanboardjsonResponse['result'][0]['id'];
			$description = $kanboardjsonResponse['result'][0]['description'];
			$description .= "\n";
			$description .= $paymentinfo;

			//update task with payment info in description
			$kanboardresponse = $kanboardclient->request('POST', 'jsonrpc.php', [
				'auth' => [$kanboardName, $kanboardAccessKey],
				'json' => [
					'jsonrpc' => '2.0',
					'method'=>'updateTask',
					'id'=>'1',
					'params'=>[
						'id' => $task_id,
						'description' => $description,
					]
				]
			]);

			//move task into different column
			$kanboardresponse = $kanboardclient->request('POST', 'jsonrpc.php', [
				'auth' => [$kanboardName, $kanboardAccessKey],
				'json' => [
					'jsonrpc' => '2.0',
					'method'=>'moveTaskPosition',
					'id'=>'1',
					'params'=>[
						'project_id' => $project_id,
			    'task_id' => $task_id,
			    'column_id' => $column_id,
			    'position' => 1,
			    'swimlane_id' => 12,
					]
				]
			]);
		    }
		}
		break;
}
