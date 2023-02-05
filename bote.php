<?php

require_once('simplevk-master/autoload.php');//Библиотека для работы с vk_api
require './vendor/autoload.php';//Библиотека для работы с БД

use Krugozor\Database\Mysql\Mysql as Mysql; // Классы для работы с БД
use DigitalStar\vk_api\vk_api; // Основной класс
use DigitalStar\vk_api\Message; // Конструктор сообщений
use DigitalStar\vk_api\VkApiException; // Обработка ошибок

const HOST = 'localhost'; // По умолчанию localhost или IP адрес сервера
const USER_NAME = 'crepercrep_vkbot'; //Логин для авторизации
const PASSWORD = 'w0GU&TeK'; // Пароль для авторизации
const BDNAME = 'crepercrep_vkbot'; // Имя БД
const VK_KEY = "6f1a03cb51a34a2c3751ffed4e42fa67bdedafe523788b7c8ef2fb8de3ab2653aa2dff0c459d8054b1d93";  // Токен сообщества
const ACCESS_KEY = "c7acc906";  // Ключ, который должен вернуть сервер
const VERSION = "5.126"; // Версия API VK

$db = Mysql::create(HOST, USER_NAME, PASSWORD)->setDatabaseName(BDNAME)->setCharset('utf8mb4');
$vk = vk_api::create(VK_KEY, VERSION)->setConfirm(ACCESS_KEY);
//=================================================
$vk->initVars($peer_id, $message, $payload, $vk_id, $type, $data); // Инициализация переменных. Проще говоря библиотека сама создает нужные переменные
$data = json_decode(file_get_contents('php://input')); //Дата отдельно, чтобы можно было вручную добраться до некоторых данных
$time = time();                                        //Это время
$mis = explode(" ", mb_strtoupper($message, 'UTF-8')); //Мы разбиваем сообщение на массив из слов
$alf = 'АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';               //Алфавит
$arr_alf = preg_split('//u',$alf,-1, PREG_SPLIT_NO_EMPTY);//Массивы из букв алфавита
$arr_alf2 = preg_split('//u',$alf,-1, PREG_SPLIT_NO_EMPTY);
 ////////////////////////////////////////////////////Это кнопки, что используются
$btn_begin = $vk->buttonText('Начало', 'white', ['command' => 'btn_begin']);
$btn_money = $vk->buttonText('💰Средства', 'blue', ['command' => 'btn_money']);
$btn_shop = $vk->buttonText('🏪Магазин', 'white', ['command' => 'btn_shop']);
$btn_shop_word = $vk->buttonText('+1 к допустимой длине пароля', 'green', ['command' => 'btn_shop_word']);
$btn_shop_hack = $vk->buttonText('+2 попытки во время взлома', 'green', ['command' => 'btn_shop_hack']);
$btn_shop_input = $vk->buttonText('+1 к длине вводимых символов', 'green', ['command' => 'btn_shop_input']);
$btn_shop_fr = $vk->buttonText('Случайная фраза', 'blue', ['command' => 'btn_shop_fr']);
$btn_mission = $vk->buttonText('🧳Миссии', 'white', ['command' => 'btn_mission']);
$btn_mission_s = $vk->buttonText('Сюжет', 'blue', ['command' => 'btn_mission_s']);
$btn_mission_v = $vk->buttonText('Взлом', 'blue', ['command' => 'btn_mission_v']);
$btn_mission_z = $vk->buttonText('Превосходство', 'blue', ['command' => 'btn_mission_z']);
$btn_hack = $vk->buttonText('🕶Кража', 'red', ['command' => 'btn_hack']);
$btn_hack_stop = $vk->buttonText('Чтобы выйти из взлома наберите:"Выход"', 'white', ['command' => 'btn_hack_stop']);
$btn_hack_rand = $vk->buttonText('Случайный человек', 'white', ['command' => 'btn_hack_rand']);
$btn_hack_det = $vk->buttonText('Выбранный человек', 'blue', ['command' => 'btn_hack_det']);
$btn_hack_det_yes = $vk->buttonText('Взломать', 'red', ['command' => 'btn_hack_det_yes']);
$btn_help = $vk->buttonText('❔Помощь', 'green', ['command' => 'btn_help']);
$btn_help_play = $vk->buttonText('Как играть?', 'green', ['command' => 'btn_help_play']);
$btn_help_mission = $vk->buttonText('Миссии?', 'green', ['command' => 'btn_help_mission']);
$btn_help_hack = $vk->buttonText('Кража?', 'green', ['command' => 'btn_help_hack']);
$btn_help_word = $vk->buttonText('Пароль?', 'green', ['command' => 'btn_help_word']);
$btn_word = $vk->buttonText('🔐Пароль', 'blue', ['command' => 'btn_word']);
$btn_word_change = $vk->buttonText('Изменить пароль', 'blue', ['command' => 'btn_word_change']);
////////////////////////////////////////////Это кнопки, что используются в миссиях
$btn_m1b1 = $vk->buttonText('Да, это я', 'blue', ['command' => 'btn_m1b1']);
$btn_mdisc = $vk->buttonText('/disconnect', 'red', ['command' => 'btn_mdisc']);
$btn_m1b3 = $vk->buttonText('Носитель (C:)', 'blue', ['command' => 'btn_m1b3']);
$btn_m1b3_1 = $vk->buttonText('\System', 'white', ['command' => 'btn_m1b3_1']);
$btn_m1b3_2 = $vk->buttonText('\работа', 'white', ['command' => 'btn_m1b3_2']);
$btn_m1b3_2_1 = $vk->buttonText('\отчеты', 'white', ['command' => 'btn_m1b3_2_1']);
$btn_m1b3_2_2 = $vk->buttonText('\данные', 'white', ['command' => 'btn_m1b3_2_2']);
$btn_m1b3_2_2_1 = $vk->buttonText('\сводки', 'white', ['command' => 'btn_m1b3_2_2_1']);
$btn_m1b3_2_2_2 = $vk->buttonText('\таблицы', 'white', ['command' => 'btn_m1b3_2_2_2']);
$btn_m1b3_2_3 = $vk->buttonText('\план', 'white', ['command' => 'btn_m1b3_2_3']);
$btn_m1b4 = $vk->buttonText('Носитель (D:)', 'blue', ['command' => 'btn_m1b4']);
$btn_m1b4_1 = $vk->buttonText('\дочь', 'white', ['command' => 'btn_m1b4_1']);
$btn_m1b4_1_1 = $vk->buttonText('\фото', 'white', ['command' => 'btn_m1b4_1_1']);
$btn_m1b4_1_2 = $vk->buttonText('\напоминание.txt', 'green', ['command' => 'btn_m1b4_1_2']);
$btn_m1b4_2 = $vk->buttonText('\записи', 'white', ['command' => 'btn_m1b4_2']);
$btn_m1b4_3 = $vk->buttonText('\31102044', 'white', ['command' => 'btn_m1b4_3']);
$btn_m1b5 = $vk->buttonText('|Удалить все данные|', 'red', ['command' => 'btn_m1b5']);
$btn_m1b6 = $vk->buttonText('|Удалить сводки|', 'red', ['command' => 'btn_m1b6']);
$btn_m1b7 = $vk->buttonText('Да, я удалил сводки', 'blue', ['command' => 'btn_m1b7']);
$btn_m1b8 = $vk->buttonText('Да, я сделал, как ты сказала', 'blue', ['command' => 'btn_m1b8']);

$btn_m2b0 = $vk->buttonText('Да, я готов', 'blue', ['command' => 'btn_m2b0']);
$btn_m2b1 = $vk->buttonText('Начать передачу данных', 'green', ['command' => 'btn_m2b1']);
$btn_m2b2 = $vk->buttonText('Войти в БД', 'blue', ['command' => 'btn_m2b2']);
$btn_m2b3 = $vk->buttonText('Данные об админах', 'white', ['command' => 'btn_m2b3']);
$btn_m2b4 = $vk->buttonText('Изменить данные Джона', 'blue', ['command' => 'btn_m2b4']);
$btn_m2b5 = $vk->buttonText('Просмотреть БД', 'white', ['command' => 'btn_m2b5']);
$btn_m2b6 = $vk->buttonText('Удалить жалобы', 'white', ['command' => 'btn_m2b6']);

$btn_m3b0 = $vk->buttonText('Да', 'blue', ['command' => 'btn_m3b0']);
$btn_m3b1 = $vk->buttonText('Как настроиться на частоту?', 'blue', ['command' => 'btn_m3b1']);
$btn_m3b2 = $vk->buttonText('Кто ты вообще такая?', 'blue', ['command' => 'btn_m3b2']);
$btn_m3b3 = $vk->buttonText('Но мне хотелось бы узнать', 'blue', ['command' => 'btn_m3b3']);

$btn_m4b0 = $vk->buttonText('Готов', 'blue', ['command' => 'btn_m4b0']);
$btn_m4b1 = $vk->buttonText('Подключаюсь', 'green', ['command' => 'btn_m4b1']);
$btn_m4b2 = $vk->buttonText('Твоё имя что-то напоминает', 'white', ['command' => 'btn_m4b2']);
$btn_m4b3 = $vk->buttonText('Твоё имя что-то напоминает', 'white', ['command' => 'btn_m4b3']);
$btn_m4b4 = $vk->buttonText('Твоё имя что-то напоминает', 'white', ['command' => 'btn_m4b4']);
$btn_m4b5 = $vk->buttonText('Твоё имя что-то напоминает', 'blue', ['command' => 'btn_m4b5']);
$btn_m4b6 = $vk->buttonText('Твоё имя что-то напоминает', 'green', ['command' => 'btn_m4b6']);
$btn_m4b7 = $vk->buttonText('Твоё имя что-то напоминает', 'red', ['command' => 'btn_m4b7']);

$btn_m5b0 = $vk->buttonText('Я готов', 'blue', ['command' => 'btn_m5b0']);
$btn_m5b1 = $vk->buttonText('Подключиться', 'green', ['command' => 'btn_m5b1']);
$btn_m5b2 = $vk->buttonText('/disconnect', 'red', ['command' => 'btn_m5b2']);
$btn_m5b3 = $vk->buttonText('Всё в порядке', 'green', ['command' => 'btn_m5b3']);
$btn_m5b4 = $vk->buttonText('Пока', 'blue', ['command' => 'btn_m5b4']);
$btn_m5b5 = $vk->buttonText('Спасибо тебе', 'white', ['command' => 'btn_m5b5']);

$btn_m6b0 = $vk->buttonText('Готов', 'blue', ['command' => 'btn_m6b0']);
$btn_m6b1 = $vk->buttonText('//Взломать камеры блока D//', 'green', ['command' => 'btn_m6b1']);
$btn_m6b2 = $vk->buttonText('Выбора нет', 'green', ['command' => 'btn_m6b2']);
$btn_m6b3 = $vk->buttonText('Нет, не надо, я заставлю его уйти', 'green', ['command' => 'btn_m6b3']);
$btn_m6b4 = $vk->buttonText('Нет, не надо, я заставлю его уйти', 'green', ['command' => 'btn_m6b4']);
$btn_m6b5 = $vk->buttonText('//Взломать дверь C9-06//', 'blue', ['command' => 'btn_m6b5']);

$btn_m7b0 = $vk->buttonText('Да, именно так', 'blue', ['command' => 'btn_m7b0']);
$btn_m7b1 = $vk->buttonText('//Вспомнить//', 'green', ['command' => 'btn_m7b1']);
$btn_m7b2 = $vk->buttonText('//Попрощаться с Марией//', 'red', ['command' => 'btn_m7b2']);
//////////////////////////////////////////////


if ($vk_id < 0){exit();} //Проверяем, что сообщение пришло от человека, а не сообщества
if ($data->type == 'message_new') { // Создаем проверку на новое сообщение 
	$payload = $payload['command']; //Делаем, чтобы payload был равен command
	$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word']; //Вытягиваем пароль пользователя из бд
	$shop_word = (strlen($word))/2;                                                               //Узнаем длину пароля, тк русские буквы весят 2 бита, то делим на 2
	$stat = $db->query('SELECT stat FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['stat']; //Узнаем нынешний Статус

	if (($message == 'Выход')or($message == 'выход')) { //Выход - экстренный выход из взлома
		if (($stat == 2)or($stat == 4)or($stat == 5)){ //Мы обнуляем все данные, что использовались
			$db->query('UPDATE users SET stat = ?i,word_g = "?s",word_see = "?s",reward = ?i,turn = ?i,vkfwd_id = ?i,alf = "?s",have = "?s",word_bot = "?s" WHERE vk_id = ?i',0,NULL,NULL,0,0,0,NULL,NULL,NULL,$vk_id); 
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]); //Мы отсылаем сообщение с кнопками, грубо говоря возвращаем в начало
			exit();
		}
	}
	
	if ($payload == 'btn_begin'){ //При нажатии кнопки Начало происходят
		$reward = $db->query('SELECT reward FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['reward'];//Узнаем награду
		if($reward == 1){                                           //Если награда 1, значит сейчас момент, когда человека спрашивают про взлом
			$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', 0, $vk_id); //Благодаря чему мы можем обнулить не все, а измененные данные
			$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
		}
		if ($word == "1"){                                                  //Если пароль=1, это значит, что пользователь в фазе изменения пароля
			$word = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];//Поэтому при нажатии Начало
			$db->query('UPDATE users SET word = "?s" WHERE vk_id = ?i',  $word, $vk_id);             //Нужно вернуть пароль, какой он стоял раньше
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i',  NULL, $vk_id);
			}
		if ($stat == 1){                                         //Статус 1 - это фаза, когда игрока должен переслать сообщение человек
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id); //Что также позволяет удалить только измененные строки
			$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
		}
		if ($stat == 3){                                        //Статус 3 - это меню с миссиям, в ней ничего не затронуто, кроме самого статуса
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id); 
		}                                                                                        //И в конце концов вызываем начальные кнопки
		$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
		exit();
	}
	if ($payload == 'btn_mission_s'){ //Эта кнопка рассказывает про сюжет
		$vk->sendButton($peer_id, "Сюжет - помимо простого взлома здесь будет также текст, в котором вы узнаете историю об организации Фиолетовая Паутина", [[$btn_mission_s, $btn_mission_v], [$btn_mission_z, $btn_begin]]);
		$vk->sendMessage($peer_id, "Доступные миссии:(С 1-7). Лучше проходить по порядку");
		exit();
	}
	if ($payload == 'btn_mission_v'){ //Эта кнопка рассказывает про Взлом
		$vk->sendButton($peer_id, "Взлом - просто взлом случайного пароля. Первый уровень(В 1) - бесплатный!", [[$btn_mission_s, $btn_mission_v], [$btn_mission_z, $btn_begin]]);
		$vk->sendMessage($peer_id, "Доступные миссии:(В 1-20)");
		exit();
	}
	if ($payload == 'btn_mission_z'){ //А это про превосходство
		$vk->sendButton($peer_id, "Превосходство - взлом, во время которого вас также взламывает бот, кто взломает первым - тот и победил.", [[$btn_mission_s, $btn_mission_v], [$btn_mission_z, $btn_begin]]);
		$vk->sendMessage($peer_id, "Доступные миссии:(П 1-20)");
		exit();
	}
	//=================================================================
	//Сюжет================================================================
	if ($stat == 6){
		$story = $db->query('SELECT story FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['story'];//узнаем важную переменную
		$a = (int)($story/10000); //Это количество десяток тысяч, они не используются, но хотел ими обозначать, какие миссия пройдены, а какие нет
		$b =(int)(($story % 10000)/1000); //Это тысяч, они говорят про выбора в отношении Марии
		$c =(int)(($story % 1000)/100);//Это сотен, они говорят о выборах в отношении мужчины
		$d = (int)(($story % 100)/10);//А это десятки, они говорят, какая фаза миссии
		$f = $story % 10;             //И это единицы, они говорят, какая текущая миссия
		if($payload == 'btn_mdisc'){ //В самом начале миссий проверяем, случайно ли ввел игрока сюжет
			$story-=$f;             //Если да, то эта кнопка позволяет вернуться
			$db->query('UPDATE users SET stat = ?i,word_see = "?s",turn = ?i,story = ?i WHERE vk_id = ?i',0,NULL,0,$story, $vk_id);
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			exit();
		}
		
		if($f == 1){ //Первая миссия
			if($d == 0){ //Первая фаза первой миссии
				if($payload == 'btn_m1b1'){
					$userinfo = $vk->userInfo($vk_id);
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
					$vk->sendButton($peer_id, "Отлично, меня можешь звать Мария. Задания тебе диктоваться будут через меня", [[]]);
					sleep(4);
					$vk->sendMessage($peer_id, "Необходимо взломать одного работничка, обычный жулик, как и все в этой корпорации");
					sleep(4);
					$vk->sendMessage($peer_id, "Сейчас создам сеть между тобой и его компьютером");
					sleep(3);
					$vk->sendMessage($peer_id, "Когда взломаешь - удали все его данные нашей программой");
					sleep(3);
					$vk->sendMessage($peer_id, "У него где-то хранится сводка наших передач, когда шифрование дало сбой");
					sleep(4);
					$vk->sendMessage($peer_id, "Времени нет, чтобы искать, поэтому просто сноси там все");
					sleep(3);
					$vk->sendMessage($peer_id, "Программа не оставит и следа от прошлых данных");
					sleep(3);
					$vk->sendMessage($peer_id, "Так, вот и оно, у него должен быть простой пароль");
					sleep(3);
					$vk->sendMessage($peer_id, "Человек он не большого ума, может что-то, что любит, типа денег, алкоголя или еще чего");
					sleep(5);
					$vk->sendMessage($peer_id, "В общем, разберешься, удачи и не подведи нас, $userinfo[first_name]");
					sleep(3);
					$vk->sendMessage($peer_id, "||Сеть создана, подключение...||");
					sleep(3);
					$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|> ****** |\/| |Осталось попыток|> $turn", [[]]);
					exit();
				}
			}
			if($d == 1){
				$word_g = "МИЛЕНА";
				$message = mb_strtoupper($message, 'UTF-8');
				$len_word = 6;
				$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];
				$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
				if (!(preg_match('/^[А-Я]++$/ui', $message))){
					$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
					exit();
				}
				if ((strlen($message))/2 > $shop_input){       
					$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
					exit();
				}
				$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
				$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY);
				$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
				$ar_word = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY);
				$have = '';
				$kk=0; 
				for ($i=0; $i<$shop_input; $i++){
					if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}
					if($ar_message[$i]==$ar_word[$kk]){
						if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];}
					}
					else{
						for ($k=0; $k<$len_word; $k++){
							if($ar_message[$i]==$ar_word[$k]){$have=$have.$ar_word[$k];}
						}
					}
					$word_see = implode("", $ar_word_see);
					$kk+=1;
				}
				if ($word_see == $word_g){
					$vk->sendMessage($peer_id, "|Доступ разрешен|");
					sleep(2);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "(C:) \n (D:)", [[$btn_m1b3],[$btn_m1b4],[$btn_m1b5]]);
					exit();
				}
				$turn = $turn-1;
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
				$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
				if ($turn == 0){
					$vk->sendMessage($peer_id, "|Потеря соединения...|");
					$story-=11;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					sleep(2);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$vk->sendMessage($peer_id, "|~Все это действительно было? Или это слишком реальный сон?~|");
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[]]);
				exit();
			}
			if($d == 2){
				if($payload == 'btn_m1b5'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendMessage($peer_id, "|Все данные были удалены|");
					sleep(2);
					$vk->sendMessage($peer_id, "|Отключение...|");
					sleep(2);
					$vk->sendButton($peer_id, "Ты уже всё? Все данные удалены?", [[$btn_m1b7], [$btn_m1b8]]);
					exit();
				}
				if($payload == 'btn_m1b3'){
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n (D:)", [[$btn_m1b3], [$btn_m1b3_1, $btn_m1b3_2], [$btn_m1b4], [$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b3_1'){
					$vk->sendMessage($peer_id, "|Доступ запрещен|");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n (D:)", [[$btn_m1b3],[$btn_m1b3_1, $btn_m1b3_2],[$btn_m1b4], [$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b3_2'){
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n ......отчеты \n ......данные \n ......план \n (D:)", [[$btn_m1b3, $btn_m1b3_2],[$btn_m1b3_2_1, $btn_m1b3_2_2, $btn_m1b3_2_3],[$btn_m1b4],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b3_2_1'){
					$vk->sendMessage($peer_id, "//В папке полно файлов с датами, в которых в основном написано, что все в порядке//");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n ......отчеты \n ......данные \n ......план \n (D:)", [[$btn_m1b3, $btn_m1b3_2],[$btn_m1b3_2_1, $btn_m1b3_2_2, $btn_m1b3_2_3],[$btn_m1b4],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b3_2_2'){
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n ......отчеты \n ......данные \n .........сводки \n .........таблицы \n ......план \n (D:)", [[$btn_m1b3, $btn_m1b3_2, $btn_m1b3_2_2],[$btn_m1b3_2_2_1, $btn_m1b3_2_2_2],[$btn_m1b4],[$btn_m1b5, $btn_m1b6]]);
					exit();
				}
				if($payload == 'btn_m1b3_2_2_1'){
					$vk->sendMessage($peer_id, "//Именно здесь хранятся сводки, которые не должны существовать//");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n ......отчеты \n ......данные \n .........сводки \n .........таблицы \n ......план \n (D:)", [[$btn_m1b3, $btn_m1b3_2, $btn_m1b3_2_2],[$btn_m1b3_2_2_1, $btn_m1b3_2_2_2],[$btn_m1b4],[$btn_m1b5, $btn_m1b6]]);
					exit();
				}
				if($payload == 'btn_m1b3_2_2_2'){
					$vk->sendMessage($peer_id, "//Папка содержит много таблиц, о доходах, расходах и другом... доходы снова увеличились//");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n ......отчеты \n ......данные \n .........сводки \n .........таблицы \n ......план \n (D:)", [[$btn_m1b3, $btn_m1b3_2, $btn_m1b3_2_2],[$btn_m1b3_2_2_1, $btn_m1b3_2_2_2],[$btn_m1b4],[$btn_m1b5, $btn_m1b6]]);
					exit();
				}
				if($payload == 'btn_m1b3_2_3'){
					$vk->sendMessage($peer_id, "//В папке лежит лишь один файл из 1337 страниц//");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n ...System \n ...работа \n ......отчеты \n ......данные \n ......план \n (D:)", [[$btn_m1b3, $btn_m1b3_2],[$btn_m1b3_2_1, $btn_m1b3_2_2, $btn_m1b3_2_3],[$btn_m1b4],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b4'){
					$vk->sendButton($peer_id, "(C:) \n (D:) \n ...дочь \n ...записи \n ...31102044", [[$btn_m1b3] ,[$btn_m1b4],[$btn_m1b4_1, $btn_m1b4_2, $btn_m1b4_3],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b4_1'){
					$vk->sendButton($peer_id, "(C:) \n (D:) \n ...дочь \n ......фото \n ......напоминание.txt \n ...записи \n ...31102044", [[$btn_m1b3] ,[$btn_m1b4, $btn_m1b4_1],[$btn_m1b4_1_1, $btn_m1b4_1_2],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b4_1_1'){
					$vk->sendMessage($peer_id, "//В папке совсем немного фотографий мужчины и ребёнка, последняя была сделана в этом году//");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n (D:) \n ...дочь \n ......фото \n ......напоминание.txt \n ...записи \n ...31102044", [[$btn_m1b3] ,[$btn_m1b4, $btn_m1b4_1],[$btn_m1b4_1_1, $btn_m1b4_1_2],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b4_1_2'){
					$vk->sendMessage($peer_id, "||Хлоя ушла от нас и я должен принять это, смириться и жить дальше \n Я пишу тебе, Я, никогда не сдавайся и живи ради Милены, только ты сможешь подарить ей будущее \n В этом городе много интриг и тайн, нужно уехать, ради Милены||");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n (D:) \n ...дочь \n ......фото \n ......напоминание.txt \n ...записи \n ...31102044", [[$btn_m1b3] ,[$btn_m1b4, $btn_m1b4_1],[$btn_m1b4_1_1, $btn_m1b4_1_2],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b4_2'){
					$vk->sendMessage($peer_id, "//В папке несколько файлов, в которых записаны разные города, суммы на поездку, объявления о работе, много дат, начиная с 2045 года//");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n (D:) \n ...дочь \n ...записи \n ...31102044", [[$btn_m1b3] ,[$btn_m1b4],[$btn_m1b4_1, $btn_m1b4_2, $btn_m1b4_3],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b4_3'){
					$vk->sendMessage($peer_id, "//В папке много фотографий девушки, мужчины и ребёнка, последняя была сделана в 2044 году//");
					sleep(1);
					$vk->sendButton($peer_id, "(C:) \n (D:) \n ...дочь \n ...записи \n ...31102044", [[$btn_m1b3] ,[$btn_m1b4],[$btn_m1b4_1, $btn_m1b4_2, $btn_m1b4_3],[$btn_m1b5]]);
					exit();
				}
				if($payload == 'btn_m1b6'){
					if(($c==1)or($c==4)or($c==5)){$story+=10;}
					if(($c==2)or($c==3)){$story+=210;}
					if(($c==0)or($c==6)){$story+=110;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendMessage($peer_id, "|сводки были удалены|");
					sleep(2);
					$vk->sendMessage($peer_id, "|Отключение...|");
					sleep(2);
					$vk->sendButton($peer_id, "Ты уже всё? Все данные удалены?", [[$btn_m1b7] ,[$btn_m1b8]]);
					exit();
				}
			}
			if($d == 3){ // четвертая фаза первой миссии
				if($payload == 'btn_m1b7'){$vk->sendButton($peer_id, "Отлично, они больше не будут угрозой для нас", [[]]);}
				if($payload == 'btn_m1b8'){$vk->sendButton($peer_id, "Хорошо, если это так, эти сводки могли бы стать угрозой для нас", [[]]);}
				sleep(3);
				$vk->sendMessage($peer_id, "Во всяком случае поздравляю!");
				sleep(2);
				$vk->sendMessage($peer_id, "Ты теперь один из нас и это факт");
				sleep(2);
				$vk->sendMessage($peer_id, "Как минимум факт того, что ты уже вовлечен во всю эту паутину");
				sleep(4);
				$vk->sendMessage($peer_id, "Надеемся, что ты и дальше будешь справляться с заданимями");
				sleep(4);
				$vk->sendMessage($peer_id, "Скоро нагрянет большое дело, будь готов");
				sleep(3);
				$vk->sendMessage($peer_id, "А пока отдыхай, скоро я еще пришлю тебе задачу");
				sleep(3);
				$story-=31;
				$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
				$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
				$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
				exit();
			}
		}
		
		if($f == 2){ //Вторая миссия
			if($d == 0){//первая фаза второй миссии
				if($payload == 'btn_m2b0'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
					shuffle($arr_alf);
					$word = mb_substr(implode($arr_alf), 0, 5,'UTF-8');
					$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word, $vk_id);
					$vk->sendButton($peer_id, "Хорошо, мы раздобыли идентификационный номер одного из администраторов", [[]]);
					sleep(4);
					$vk->sendMessage($peer_id, "Но мы не знаем другие его данные");
					sleep(2);
					$vk->sendMessage($peer_id, "Поэтому зайти в их БД не сможем");
					sleep(2);
					$vk->sendMessage($peer_id, "Тебе нужно взломать сервер и выкачать данные о админах");
					sleep(3);
					$vk->sendMessage($peer_id, "А затем мы подберем к номеру нужные данные, чтобы зайти");
					sleep(3);
					$vk->sendMessage($peer_id, "После этого ты изменишь некоторую запись, чтобы наш человек оказался работником корпы");
					sleep(5);
					$vk->sendMessage($peer_id, "Все ясно? Хорошо, я создаю сеть, удачи");
					sleep(2);
					$vk->sendMessage($peer_id, "||Сеть создана, подключение...||");
					sleep(2);
					$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|> ***** |\/| |Осталось попыток|> $turn", [[]]);
					exit();
				}
			}
			if($d == 1){
				$word_g = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];
				$message = mb_strtoupper($message, 'UTF-8');
				$len_word = 5;
				$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];
				$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
				if (!(preg_match('/^[А-Я]++$/ui', $message))){
					$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
					exit();
				}
				if ((strlen($message))/2 > $shop_input){       
					$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
					exit();
				}
				$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
				$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY);
				$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
				$ar_word = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY);
				$have = '';
				$kk=0; 
				for ($i=0; $i<$shop_input; $i++){
					if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}
					if($ar_message[$i]==$ar_word[$kk]){
						if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];}
					}
					else{
						for ($k=0; $k<$len_word; $k++){
							if($ar_message[$i]==$ar_word[$k]){$have=$have.$ar_word[$k];}
						}
					}
					$word_see = implode("", $ar_word_see);
					$kk+=1;
				}
				if ($word_see == $word_g){
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "|Доступ разрешен|", [[$btn_m2b1]]);
					exit();
				}
				$turn = $turn-1;
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
				$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
				if ($turn == 0){
					$vk->sendMessage($peer_id, "|Потеря соединения...|");
					$story-=12;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					sleep(2);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$vk->sendMessage($peer_id, "|~Все это действительно было? Или это слишком реальный сон?~|");
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[]]);
				exit();
			}
			if($d == 2){
				if($payload == 'btn_m2b1'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "|Начата загрузка данных|", [[]]);
					sleep(1);
					$vk->sendMessage($peer_id, ".");
					sleep(1);
					$vk->sendMessage($peer_id, "..");
					sleep(1);
					$vk->sendMessage($peer_id, "...");
					sleep(1);
					$vk->sendMessage($peer_id, ".");
					sleep(1);
					$vk->sendMessage($peer_id, "..");
					sleep(1);
					$vk->sendMessage($peer_id, "|Загрузка завершена|");
					sleep(2);
					$vk->sendMessage($peer_id, "Прием, хорошая работа, данные у нас. К счастью, людей не так много");
					sleep(3);
					$vk->sendMessage($peer_id, "Сейчас подключим тебя к БД и вышлю данные с номером");
					sleep(2);
					$vk->sendMessage($peer_id, "Тебе нужно понять, к какому человеку относится номер и зайти в БД");
					sleep(3);
					$vk->sendMessage($peer_id, "Хорошо, есть соединение, удачи");
					sleep(2);
					$vk->sendButton($peer_id, "|Войдите в БД, нажав Войти и набрав затем ваш идентификационный номер и Фамилию|", [[$btn_m2b2],[$btn_m2b3]]);
					exit();
				}
			}
			if($d == 3){
				if($payload == 'btn_m2b2'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "|Введите номер и Фамилию| \n Например: 12345678910 Иванов", [[]]);
					exit();
				}
				if($payload == 'btn_m2b3'){
					$p1 = '|Леон Денир|Подразделение:107-01|Стаж: 9 лет|Дата рождения:19.08.1973|';
					$p2 = '|Марк Джефферсон|Подразделение:107-01|Стаж: 8 лет|Дата рождения:11.04.1985|';
					$p3 = '|Григорий Семецкий|Подразделение:107-01|Стаж: 11 лет|Дата рождения:03.09.1971|';
					$p4 = '|Рон Миронов|Подразделение:107-02|Стаж: 3 лет|Дата рождения:13.08.1998|';
					$p5 = '|Грей Фокс|Подразделение:106-02|Стаж: 4 лет|Дата рождения:25.08.1985|';
					$p6 = '|Шон Лобанов|Подразделение:107-03|Стаж: 2 лет|Дата рождения:13.08.1998|';
					$p7 = '|Тоби Дельтос|Подразделение:106-03|Стаж: 1 лет|Дата рождения:03.01.2001|';
					$vk->sendMessage($peer_id, "Идентификационный номер: 25302130898 \n Админы: \n $p1 \n $p2 \n $p3 \n $p4 \n $p5 \n $p6 \n $p7 ");
					exit();
				}
				
			}
			if($d == 4){
				if($message == '25302130898 Миронов'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendMessage($peer_id, "|Вход успешен|");
					sleep(2);
					$vk->sendMessage($peer_id, "Отлично, ты в БД");
					sleep(2);
					$vk->sendMessage($peer_id, "Измени данные Джона Никоса, что нужно изменить сейчас отправлю");
					sleep(4);
					$vk->sendMessage($peer_id, "|Данные получены|");
					sleep(2);
					$vk->sendMessage($peer_id, "Давай быстрее, осталось немного");
					sleep(3);
					$vk->sendButton($peer_id, "//Вы нашли запись Джона, как ни странно она оказалось недалеко//", [[$btn_m2b4],[$btn_m2b5]]);
					exit();
				}else{
					$story-=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendMessage($peer_id, "|Ошибка|");
					sleep(2);
					$vk->sendButton($peer_id, "|Войдите в БД, нажав Войти и набрав затем ваш идентификационный номер и Фамилию|", [[$btn_m2b2],[$btn_m2b3]]);
					exit();
				}
			}
			if($d == 5){
				if($payload == 'btn_m2b4'){
					$story-=52;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$vk->sendButton($peer_id, "|Строка успешно изменена|", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "|Отключение...|");
					sleep(2);
					$vk->sendMessage($peer_id, "Превосходно! Никаких проблем не было");
					sleep(2);
					$vk->sendMessage($peer_id, "Даже из охраны никто и не дернулся");
					sleep(2);
					$vk->sendMessage($peer_id, "Хорошая работа! Отдыхай, как только мы подготовимся - я тебя позову");
					sleep(4);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
					
				}
				if($payload == 'btn_m2b5'){
					$vk->sendButton($peer_id, "//Вас привлекла запись с 6 жалобами, у нее есть комментарий:'Хочет свалить от нас, кидайте ему жалобы, чтоб не сбежал'//", [[$btn_m2b4],[$btn_m2b6]]);
					exit();
				}
				if($payload == 'btn_m2b6'){
					if(($c==2)or($c==4)or($c==6)){$story+=0;}
					if(($c==0)or($c==5)){$story+=200;}
					if(($c==1)or($c==3)){$story+=300;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "//Вы удалили все жалобы//", [[$btn_m2b4]]);
					exit();
				}
			}
		}
		
		if($f == 3){ //Третья миссия
			if($d == 0){
				if($payload == 'btn_m3b0'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "В общем наш человек проник здания и поставил устройства", [[]]);
					sleep(3);
					$vk->sendMessage($peer_id, "Они помогут нам без проблем пробиться через сеть корпы");
					sleep(3);
					$vk->sendMessage($peer_id, "Через них мы взломаем главную защиту и получим доступ к главному серверу");
					sleep(4);
					$vk->sendMessage($peer_id, "Но сейчас нужна настройка, ты должен настроиться на нужную частоту");
					sleep(3);
					$vk->sendButton($peer_id, "Могу рассказать, как настраиваться", [[$btn_m3b1],[$btn_m3b2]]);
					exit();
				}
			}
			if($d == 1){
				if($payload == 'btn_m3b1'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$numb = mt_rand(1, 1024);
					$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', $numb, $vk_id);
					$vk->sendButton($peer_id, "Нужная частота находится от 1 до 1024", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "Тебе нужно будет вписывать числа в этом пределе");
					sleep(3);
					$vk->sendMessage($peer_id, "Как только ты проверишь эту частоту, то тебе покажут, насколько ты был близок");
					sleep(4);
					$vk->sendMessage($peer_id, "И постепенно изменяя значение, ты дойдешь до это частоты");
					sleep(3);
					$vk->sendMessage($peer_id, "Это несложное задание, я думаю ты справишься, удачи");
					sleep(3);
					$vk->sendMessage($peer_id, "||Подключение...||");
					sleep(2);
					$vk->sendButton($peer_id, "|Введите значение от 1 до 1024|", [[]]);
					exit();
				}
				if($payload == 'btn_m3b2'){
					$vk->sendButton($peer_id, "Эм, ну я уже говорила, что Мария", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "Я работаю на Фиолетовую Паутину, как и ты, но дольше");
					sleep(3);
					$vk->sendMessage($peer_id, "Поэтому я, грубо говоря, твой командир");
					sleep(3);
					$vk->sendButton($peer_id, "Не думаю, что тебе стоит больше знать", [[$btn_m3b1],[$btn_m3b3]]);
					exit();
				}
				if($payload == 'btn_m3b3'){
					if(($b==1)or($b==4)or($b==5)){$story+=0;}
					if(($b==2)or($b==3)){$story+=2000;}
					if(($b==0)or($b==6)){$story+=1000;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "Оу, ну, я обычно не разговаривала много о себе", [[]]);
					sleep(3);
					$vk->sendMessage($peer_id, "Когда работаешь тут, то думаешь только о миссии");
					sleep(3);
					$vk->sendMessage($peer_id, "Да и в целом это для меня главное");
					sleep(2);
					$vk->sendMessage($peer_id, "Я здесь больше скорее из-за личных мотивов, чем за идею");
					sleep(3);
					$vk->sendMessage($peer_id, "Не то чтобы она мне не нравилась, но у меня есть цель");
					sleep(3);
					$vk->sendMessage($peer_id, "И я надеюсь, что с вашей помощью достигну ее, поэтому");
					sleep(3);
					$vk->sendButton($peer_id, "Поэтому не нужно отвлекаться и давай займемся делом", [[$btn_m3b1]]);
					exit();
				}
			}
			if($d == 2){
				$numb = $db->query('SELECT vkfwd_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['vkfwd_id'];
				if($message == $numb){
					$story-=23;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$vk->sendMessage($peer_id, "|Частота настроена|");
					sleep(2);
					$vk->sendMessage($peer_id, "Отлично! Все подключено и стабильно");
					sleep(1);
					$vk->sendMessage($peer_id, "Мы должны настроить мелочи, но как закончим, то начнём следующую миссию");
					sleep(4);
					$vk->sendMessage($peer_id, "Можешь немного отдохнуть. Скоро я снова свяжусь с тобой");
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				if(($message-$numb) < 0 ){
					if(($message-$numb) < -20 ){
						if(($message-$numb) < -150 ){
							if(($message-$numb) < -450 ){
								if(($message-$numb) < -900 ){
									$vk->sendMessage($peer_id, "............<");
									exit();
								}
								$vk->sendMessage($peer_id, "..........<**");
								exit();
							}
							$vk->sendMessage($peer_id, "........<****");
							exit();
						}
						$vk->sendMessage($peer_id, "......<******");
						exit();
					}
					$vk->sendMessage($peer_id, "....<*******>");
					exit();
				}
				if(($message-$numb) > 0 ){
					if(($message-$numb) > 20 ){
						if(($message-$numb) > 150 ){
							if(($message-$numb) > 450 ){
								if(($message-$numb) > 900 ){
									$vk->sendMessage($peer_id, ">............");
									exit();
								}
								$vk->sendMessage($peer_id, "**>..........");
								exit();
							}
							$vk->sendMessage($peer_id, "****>........");
							exit();
						}
						$vk->sendMessage($peer_id, "******>......");
						exit();
					}
					$vk->sendMessage($peer_id, "<*******>....");
					exit();
				}
			}
		}
		
		if($f == 4){ //Четвертая миссия
			if($d == 0){
				if($payload == 'btn_m4b0'){
					$vk->sendButton($peer_id, "Надеюсь, сейчас тебе предстоит взломать многоуровневую защиту", [[]]);
					sleep(4);
					$vk->sendMessage($peer_id, "Когда ты взломаешь первый слой, то мы начнем подготовку к следующему");
					sleep(4);
					$vk->sendMessage($peer_id, "Мы не можем ворваться и сломать всё, нужно действовать осторожно");
					sleep(4);
					$vk->sendMessage($peer_id, "Хорошо, скоро сеть создастся, будь готов");
					sleep(3);
					$vk->sendMessage($peer_id, "||Сеть создана||");
					sleep(2);
					$vk->sendButton($peer_id, "Ну же, давай, подключайся", [[$btn_m4b1],[$btn_m4b2]]);
					exit();
				}
				if($payload == 'btn_m4b1'){
					$vk->sendButton($peer_id, "||Подключение...||", [[]]);
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
					shuffle($arr_alf);
					$word = mb_substr(implode($arr_alf), 0, 4,'UTF-8');
					$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', '****', $vk_id);
					sleep(2);
					$vk->sendMessage($peer_id, "Удачи тебе");
					sleep(2);
					$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|> **** |\/| |Осталось попыток|> $turn", [[]]);
					exit();
				}
				if($payload == 'btn_m4b2'){
					$vk->sendButton($peer_id, "Что? Ты о чем? Времени нет, подключайся!", [[$btn_m4b1],[$btn_m4b3]]);
					exit();
				}
				if($payload == 'btn_m4b3'){
					$vk->sendButton($peer_id, "Что? Ты о чем? Времени нет, подключайся!", [[$btn_m4b1],[$btn_m4b4]]);
					exit();
				}
				if($payload == 'btn_m4b4'){
					$vk->sendButton($peer_id, "Что? Ты о чем? Времени нет, подключайся!", [[$btn_m4b1],[$btn_m4b5]]);
					exit();
				}
				if($payload == 'btn_m4b5'){
					$vk->sendButton($peer_id, "Я не понимаю, о чем ты!", [[$btn_m4b1],[$btn_m4b6]]);
					exit();
				}
				if($payload == 'btn_m4b6'){
					$vk->sendButton($peer_id, "Подключайся! Потом всё узнаешь!", [[$btn_m4b1],[$btn_m4b7]]);
					exit();
				}
				if($payload == 'btn_m4b7'){
					$vk->sendButton($peer_id, "Попробуй сначала вспомнить, а потом делать выводы", [[$btn_m4b1]]);
					if(($b==2)or($b==4)or($b==6)){$story+=0;}
					if(($b==0)or($b==5)){$story+=2000;}
					if(($b==1)or($b==3)){$story+=3000;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					exit();
				}
			}
			if($d > 0){
				$word_g = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];
				$message = mb_strtoupper($message, 'UTF-8');
				$len_word = 4;
				$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];
				$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
				if (!(preg_match('/^[А-Я]++$/ui', $message))){
					$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
					exit();
				}
				if ((strlen($message))/2 > $shop_input){       
					$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
					exit();
				}
				$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
				$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY);
				$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
				$ar_word = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY);
				$have = '';
				$kk=0; 
				for ($i=0; $i<$shop_input; $i++){
					if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}
					if($ar_message[$i]==$ar_word[$kk]){
						if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];}
					}
					else{
						for ($k=0; $k<$len_word; $k++){
							if($ar_message[$i]==$ar_word[$k]){$have=$have.$ar_word[$k];}
						}
					}
					$word_see = implode("", $ar_word_see);
					$kk+=1;
				}
				if ($word_see == $word_g){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					if($d==3){
						$story-=44;
						$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
						$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
						$vk->sendMessage($peer_id, "|Точка доступа достигнута|");
						sleep(2);
						$vk->sendMessage($peer_id, "Все получилось! Отдыхай");
						sleep(2);
						$vk->sendMessage($peer_id, "Мы прямо сейчас сейчас начнем подготовку");
						sleep(3);
						$vk->sendMessage($peer_id, "Я сообщу, когда закончим");
						sleep(2);
						$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
						exit();
					}
					$turn+=2;
					shuffle($arr_alf);
					$word = mb_substr(implode($arr_alf), 0, 4,'UTF-8');
					$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', '****', $vk_id);
					$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
					$vk->sendMessage($peer_id, "|Часть доступа получена|");
					sleep(1);
					$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|> **** |\/| |Осталось попыток|> $turn", [[]]);
					exit();
				}
				$turn = $turn-1;
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
				$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
				if ($turn == 0){
					$vk->sendMessage($peer_id, "|Потеря соединения...|");
					if($d==1){$story-=14;}
					if($d==2){$story-=24;}
					if($d==3){$story-=34;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					sleep(2);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$vk->sendMessage($peer_id, "|~Все это действительно было? Или это слишком реальный сон?~|");
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[]]);
				exit();
			}

		}
		
		if($f == 5){ //Пятая миссия
			$userinfo = $vk->userInfo($vk_id);
			if($d == 0){
				if($payload == 'btn_m5b0'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "Отлично, не будем терять времени", [[]]);
					sleep(3);
					$vk->sendMessage($peer_id, "Сейчас создам сеть");
					sleep(2);
					$vk->sendMessage($peer_id, "||Сеть создана||");
					sleep(2);
					$vk->sendMessage($peer_id, "Удачи тебе");
					sleep(2);
					$vk->sendMessage($peer_id, "||Подключение...||");
					sleep(2);
					$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|> ******* |\/| |Осталось попыток|> 9", [[]]);
					exit();
				}
			}
			if($d == 1){
				$story+=10;
				$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
				$vk->sendButton($peer_id, "|Присутствуют буквы|> $message \n |Пароль|> ******* |\/| |Осталось попыток|> 99", [[]]);
			}
			if($d == 2){
				$story+=10;
				$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
				shuffle($arr_alf);
				$word = mb_substr(implode($arr_alf), 0, 7,'UTF-8');
				$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word, $vk_id);
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', '*******', $vk_id);
				shuffle($arr_alf2);
				$alf = implode($arr_alf2);
				$db->query('UPDATE users SET alf = "?s" WHERE vk_id = ?i', $alf, $vk_id);
				$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
				$len_word = (strlen($word))/2;
				for ($i = 0; $i < $len_word ; $i++){$word_b = $word_b.'*';}
				$db->query('UPDATE users SET word_bot = "?s" WHERE vk_id = ?i', $word_b, $vk_id);
				$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
				$db->query('UPDATE users SET have = "?s" WHERE vk_id = ?i', NULL, $vk_id);
				
				$vk->sendButton($peer_id, "|Присутствуют буквы|> $message \n |Пароль|> ******* |\/| |Осталось попыток|> 999", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "|Присутствуют буквы|> $message $message \n |Пароль|> ******* |\/| |Осталось попыток|> 9999", [[]]);
				sleep(1);
				$vk->sendButton($peer_id, "|Присутствуют буквы|> $message $message \n |Пароль|> ******* |\/| |Осталось попыток|> 999999", [[]]);
				sleep(1);
				$vk->sendButton($peer_id, "|Присутствуют буквы|> $message $message \n |Пароль|> ******* |\/| |Осталось попыток|> 999999999", [[$btn_m5b1]]);
				sleep(1);
				$btn_m5b1 = $vk->buttonText('Подключиться', 'blue', ['command' => 'btn_m5b1']);
				$vk->sendButton($peer_id, "|Пр&сутс*вуют буквы|= \n |аПроль|> ***_**** |\/| |Остало<**=>попыток|> 999969696999", [[$btn_m5b1],[$btn_m5b2]]);
				sleep(1);
				$btn_m5b1 = $vk->buttonText('Подключиться', 'red', ['command' => 'btn_m5b1']);
				$btn_m5b2 = $vk->buttonText('/disconnect', 'blue', ['command' => 'btn_m5b2']);
				$vk->sendButton($peer_id, "|||||Пр&А(ТС*вHютб)EвL|P= \n |/б_оль|> ***_**** |\/_ _jстало<**=>%^пыток|> 666666666666666", [[$btn_m5b1],[$btn_m5b2]]);
				sleep(1);
				$btn_m5b1 = $vk->buttonText('Подключиться', 'blue', ['command' => 'btn_m5b1']);
				$btn_m5b2 = $vk->buttonText('/disconnect', 'white', ['command' => 'btn_m5b2']);
				$vk->sendButton($peer_id, "|||||Пр&А(ТС*вHютб)EвL|P= \n |/б_оль|> ***_**** |\/_ _jстало<**=>%^пыток|> 666666666666666", [[$btn_m5b1],[$btn_m5b2]]);
				$btn_m5b1 = $vk->buttonText('Подключиться', 'red', ['command' => 'btn_m5b1']);
				$btn_m5b2 = $vk->buttonText('/disconnect', 'green', ['command' => 'btn_m5b2']);
				$vk->sendButton($peer_id, "|||||Пр&А(ТС*вHютб)EвL|P= \n |/б_оль|> ***_**** |\/_ _jстало<**=>%^пыток|> 666666666666666", [[$btn_m5b1],[$btn_m5b2]]);
				$btn_m5b1 = $vk->buttonText('/disconnect', 'white', ['command' => 'btn_m5b1']);
				$btn_m5b2 = $vk->buttonText('Подключиться', 'red', ['command' => 'btn_m5b2']);
				$vk->sendButton($peer_id, "|||||Пр&А(ТС*вHютб)EвL|P= \n |/б_оль|> ***_**** |\/_ _jстало<**=>%^пыток|> 666666666666666", [[$btn_m5b1],[$btn_m5b2]]);
				$btn_m5b1 = $vk->buttonText('Подключиться', 'green', ['command' => 'btn_m5b1']);
				$btn_m5b2 = $vk->buttonText('/disconnect', 'blue', ['command' => 'btn_m5b2']);
				$vk->sendButton($peer_id, "|||||Пр&А(ТС*вHютб)EвL|P= \n |/б_оль|> ***_**** |\/_ _jстало<**=>%^пыток|> 666666666666666", [[$btn_m5b1],[$btn_m5b2]]);
				sleep(1);
				$btn_m5b1 = $vk->buttonText('no', 'red', ['command' => 'btn_m5b1']);
				$btn_m5b2 = $vk->buttonText('way', 'red', ['command' => 'btn_m5b2']);
				$vk->sendMessage($peer_id, "Эй! ЭЙ! $userinfo[first_name] !");
				$vk->sendButton($peer_id, "||_||Пр&А(ТС*вAAAютб)9в9|P= \n |/H_0ль|> ***_**** |\/_ _jстало<**=>%^п0тSp|> 666666d66g6a666666", [[$btn_m5b1],[$btn_m5b2]]);
				sleep(1);
				$btn_m5b1 = $vk->buttonText('no', 'white', ['command' => 'btn_m5b1']);
				$vk->sendMessage($peer_id, "МЫ ТЕБЯ ВЫТАЩИМ!");
				$vk->sendButton($peer_id, "||_||Пр&А(ТС*вAAAютб)9в9|P= \n |/H_0ль|> ***_**** |\/_ _jстало<**=>%^п0тSp|> 66666ыыыы6d66g6a666666", [[$btn_m5b1]]);
				sleep(2);
				$vk->sendButton($peer_id, "Всё, всё! $userinfo[first_name], все в порядке?", [[]]);
				sleep(1);
				$vk->sendMessage($peer_id, "Фух, ты здесь, но не надолго");
				sleep(2);
				$vk->sendMessage($peer_id, "У второго слоя есть защита, мы не ожидали, что нас будут в ответ взламывать!");
				sleep(4);
				$vk->sendMessage($peer_id, "Но выбора нет, мы пересоздадим сеть, ты должен успеть сломать защиту раньше, чем нас!");
				sleep(4);
				$vk->sendMessage($peer_id, "Вот, готово, не подведи, ты справишься, $userinfo[first_name]");
				sleep(3);
				$vk->sendMessage($peer_id, "|Сеть создана, подключение...|");
				sleep(2);
				$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|>******* /||\ |Ваш пароль|>$word_b", [[]]);
				exit();
			}
			if(($d > 2)and($d < 6)){
				$word_g = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];
				$message = mb_strtoupper($message, 'UTF-8');
				$len_word = 7;
				$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];
				$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
				
				if (!(preg_match('/^[А-Я]++$/ui', $message))){
					$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
					exit();
				}
				if ((strlen($message))/2 > $shop_input){
					$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
					exit();
				}
				$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY);
				$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
				$ar_wordg = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY);
				$have = '';
				$kk=0; 
				for ($i=0; $i<$shop_input; $i++){
					if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}
					if($ar_message[$i]==$ar_wordg[$kk]){
						if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];}
					}
					else{
						for ($k=0; $k<$len_word; $k++){
							if($ar_message[$i]==$ar_wordg[$k]){$have=$have.$ar_wordg[$k];}
						}
					}
					$word_see = implode("", $ar_word_see);
					$kk+=1;
				}
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);

				$word_b = $db->query('SELECT word_bot FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_bot'];
				$pos = $db->query('SELECT vkfwd_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['vkfwd_id'];
				$haveb = $db->query('SELECT have FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['have'];
				$len = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
				$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
				$shop_word = (strlen($word))/2;
				$ar_word = preg_split('//u',$word,-1, PREG_SPLIT_NO_EMPTY);
				if ($len==$shop_word){
					$k=0;
					$ar_word_b = preg_split('//u',$word_b,-1, PREG_SPLIT_NO_EMPTY);
					$ar_haveb = preg_split('//u',$haveb,-1, PREG_SPLIT_NO_EMPTY);
					shuffle($ar_haveb);
					$haveb = implode($ar_haveb);
					for ($i=0; $i<$shop_word; $i++){
						if($ar_word_b[$i] == '*'){
							if($ar_haveb[$k]==$ar_word[$i]){
								$ar_word_b[$i] = $ar_haveb[$k];
								unset($ar_haveb[$k]);
							}
							$k+=1;
						}
					}
					$word_b = implode($ar_word_b);
					$haveb = implode($ar_haveb);
				}elseif($len<$shop_word){
					$alf = $db->query('SELECT alf FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['alf'];
					$ar_word_b = preg_split('//u',$word_b,-1, PREG_SPLIT_NO_EMPTY);
					$mesb = mb_substr($alf, $pos, 6,'UTF-8');
					$ar_message = preg_split('//u',$mesb,-1, PREG_SPLIT_NO_EMPTY);
					$pos+=6;
					$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', $pos, $vk_id);
					$kk=0;
					for ($i=0; $i<6; $i++){
						if(preg_match('/^[А-Я]++$/ui', @$ar_word_b[$kk])){$kk+=1; $i-=1; continue;}
						if($ar_message[$i]==$ar_word[$kk]){
							if ($ar_word_b[$kk] == '*'){$ar_word_b[$kk] = $ar_message[$i]; $len+=1;}
						}
						else{
							for ($k=0; $k<$shop_word; $k++){
								if($ar_message[$i]==$ar_word[$k]){$haveb=$haveb.$ar_word[$k]; $len+=1;}
							}
						}
						$word_b = implode($ar_word_b);
						$kk+=1;
					}
					$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $len, $vk_id);
				}
				$db->query('UPDATE users SET word_bot = "?s" WHERE vk_id = ?i', $word_b, $vk_id);
				$db->query('UPDATE users SET have = "?s" WHERE vk_id = ?i', $haveb, $vk_id);

				if ($word_see == $word_g){
					$vk->sendMessage($peer_id, "|Доступ разрешен|");
					$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
					if($d==3){$story+=30;}
					if($d==4){$story+=20;}
					if($d==5){$story+=10;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "Приём! У нас получилось, доступ есть. Ты в порядке?", [[$btn_m5b3]]);
					exit();
				}
				if($word_b==$word){
					$vk->sendMessage($peer_id, "|Потеря соединения...|");
					if($d==3){$story-=35;}
					if($d==4){$story-=45;}
					if($d==5){$story-=55;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					sleep(2);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$vk->sendMessage($peer_id, "|~Все это действительно было? Или это слишком реальный сон?~|");
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				$warning = 0;
				foreach ($ar_word_b as $value){
					if($value == '*'){$warning+=1;}
				}
				if($d==3){
					if((($shop_word/$warning)>1.2)){
						$story+=10;
						$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					}
					$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|>$word_see /||\ |Ваш пароль|>$word_b", [[]]);
					exit();
				}
				if($d==4){
					if((($shop_word/$warning)>=2)){
						$story+=10;
						$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					}
					$vk->sendButton($peer_id, "|П?&сут?твуют б&квы|>$have \n |Па?оль|>$word_see /||_ |В?ш па?оль|>$word_b", [[]]);
					exit();
				}
				if($d==5){
					$vk->sendButton($peer_id, "|\p?&су=?т|j,/б&к%ы|>$have \n =s-?о%ь|>$word_see /=|_ |В?+nа?оLь|>$word_b", [[]]);
					exit();
				}
				exit();
			}
			if($d == 6){
				if($payload == 'btn_m5b3'){
					$vk->sendButton($peer_id, "Фух, это хорошо", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "Мы не ожидали такого, но ты всё равно справился");
					sleep(4);
					$vk->sendMessage($peer_id, "Молодец, но это ещё не конец");
					sleep(3);
					$vk->sendButton($peer_id, "Пока можешь отдохнуть, поэтому пока, я свяжусь ещё с тобой", [[$btn_m5b4],[$btn_m5b5]]);
					exit();
				}
				if($payload == 'btn_m5b4'){
					$story-=65;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$vk->sendButton($peer_id, "...", [[]]);
					sleep(2);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				if($payload == 'btn_m5b5'){
					if(($b==3)or($b==5)or($b==6)or($b==7)){$story+=0;}
					if(($b==1)or($b==2)){$story+=4000;}
					if($b==4){$story+=3000;}
					$story-=65;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$vk->sendButton($peer_id, "...", [[]]);
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
			}
		}
		
		if($f == 6){ //Шестая миссия
			if($d == 0){
				if($payload == 'btn_m6b0'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "Прекрасно, объясняю ситуацию:", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "Корпы вчера засекли нас, бот отправил сигнал сразу, как начал ломать нас");
					sleep(5);
					$vk->sendMessage($peer_id, "В итоге они физически заблокировали сервер");
					sleep(3);
					$vk->sendMessage($peer_id, "Меня отправили как лучшего агента, но мне нужна помощь");
					sleep(4);
					$vk->sendButton($peer_id, "Я нахожусь в корпусе D, отключи камеры", [[$btn_m6b1]]);
					exit();
				}
			}
			if($d == 1){
				if($payload == 'btn_m6b1'){
					$vk->sendButton($peer_id, "|Отключение...|", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "Хорошо! Сейчас пройду через офис");
					sleep(5);
					$vk->sendMessage($peer_id, "Так, я рядом с нужным коридором");
					sleep(3);
					$vk->sendMessage($peer_id, "Чёрт! Блин!");
					sleep(2);
					$vk->sendMessage($peer_id, "Там охранник...С девочкой еще какой-то");
					sleep(5);
					if($b<7){
						$vk->sendButton($peer_id, "Ушла. Отличная возможность, чтобы убрать преграду с пути", [[$btn_m6b2],[$btn_m6b3]]);
						exit();
					}
					if($b==7){
						$vk->sendButton($peer_id, "Ушла. Отличная возможность, чтобы убрать преграду с пути", [[$btn_m6b2],[$btn_m6b4]]);
						exit();
					}
				}
				if($payload == 'btn_m6b2'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "Именно так.", [[]]);
					sleep(4);
					$vk->sendButton($peer_id, "Хорошо, я внутри, открой дверь C9-06", [[$btn_m6b5]]);
					exit();
				}
				if($payload == 'btn_m6b3'){
					$btn_m6b3 = $vk->buttonText('Нет', 'red', ['command' => 'btn_m6b3']);
					$vk->sendButton($peer_id, "Ушла. Отличная возможность, чтобы убрать преграду с пути", [[$btn_m6b2],[$btn_m6b3]]);
					sleep(1);
					$vk->sendButton($peer_id, "Ушла. Отличная возможность, чтобы убрать преграду с пути", [[$btn_m6b2]]);
				}
				if($payload == 'btn_m6b4'){
					if(($c==3)or($c==5)or($c==6)or($c==7)){$story+=10;}
					if(($c==1)or($c==2)){$story+=410;}
					if($c==4){$story+=310;}
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "Действительно ушел, хорошо", [[]]);
					sleep(4);
					$vk->sendButton($peer_id, "Хорошо, я внутри, открой дверь C9-06", [[$btn_m6b5]]);
					exit();
				}
			}
			if($d == 2){
				if($payload == 'btn_m6b5'){
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$vk->sendButton($peer_id, "Отлично, вот он!", [[]]);
					sleep(3);
					$vk->sendMessage($peer_id, "Сервер, так, надо его разблокировать...");
					sleep(5);
					$vk->sendMessage($peer_id, "ЧЁРТ!");
					sleep(2);
					$vk->sendMessage($peer_id, "Ну конечно, на нём пароль");
					sleep(3);
					$vk->sendMessage($peer_id, "Хм, я вижу некоторые кнопки стерты, а ну-ка");
					sleep(4);
					$vk->sendMessage($peer_id, "Ага, хорошо, мне нужна твоя помощь");
					sleep(3);
					$vk->sendMessage($peer_id, "Говори мне комбинации букв, а я подключусь и по импульсам пойму, что правильно подобралось");
					sleep(5);
					$vk->sendMessage($peer_id, "Давай, говори комбинации из букв: АМРТЬЮ"); 
				}
			}
			if($d == 3){
				$message = mb_strtoupper($message, 'UTF-8');
				if($message=='ТЮРЬМА'){
					$story-=36;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$vk->sendMessage($peer_id, "Точно! Вот оно!"); 
					sleep(2);
					$vk->sendMessage($peer_id, "Сервер открыт, можно продолжать взламывать");
					sleep(6);
					$vk->sendMessage($peer_id, "|Связь с \Мария\ была прервана|");
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				if ((strlen($message))/2 > 6){
					$vk->sendMessage($peer_id, "Эй, это не то, введи комбинацию из букв: АМРТЬЮ");
					exit();
				}
				$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
				$a1=$a2=$a3=$a4=$a5=$a6=0;
				foreach ($ar_message as $value){
					if($value == 'А'){$a1+=1;}
					if($value == 'М'){$a2+=1;}
					if($value == 'Р'){$a3+=1;}
					if($value == 'Т'){$a4+=1;}
					if($value == 'Ь'){$a5+=1;}
					if($value == 'Ю'){$a6+=1;}
				}
				if(($a1>1)or($a2>1)or($a3>1)or($a4>1)or($a5>1)or($a6>1)){
					$vk->sendMessage($peer_id, "Эй, это не то, введи комбинацию из букв: АМРТЬЮ");
					exit();
				}
				$rand = mt_rand(1, 3);
				$hav = 0;
				foreach ($ar_message as $key => $value) {
					if (($key == 0)and($value == 'Т')){$hav+=1;}
					if (($key == 1)and($value == 'Ю')){$hav+=1;}
					if (($key == 2)and($value == 'Р')){$hav+=1;}
					if (($key == 3)and($value == 'Ь')){$hav+=1;}
					if (($key == 4)and($value == 'М')){$hav+=1;}
					if (($key == 5)and($value == 'А')){$hav+=1;}
				}
				if($rand==1){$vk->sendMessage($peer_id, "Букв стоящих на своих местах, ага - $hav");}
				if($rand==2){$vk->sendMessage($peer_id, "Букв стоящих на своих местах - $hav, но насчет одной не уверена");}
				if($rand==3){$hav+=1;$vk->sendMessage($peer_id, "Букв стоящих на своих местах - $hav, но насчет одной не уверена");}
				exit();
			}
		}
		
		if($f == 7){ //Седьмая миссия
			if($d == 0){
				if($payload == 'btn_m7b0'){
					$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
					shuffle($arr_alf);
					$word = mb_substr(implode($arr_alf), 0, 13,'UTF-8');
					$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', '*************', $vk_id);
					if(($b==7)and($c==7)){
						$story+=10;
						$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
						$turn+=5;
						$db->query('UPDATE users SET turn = "?s" WHERE vk_id = ?i', $turn, $vk_id);
						$vk->sendButton($peer_id, "|~Ты должен вспомнить и понять~|", [[]]);
						sleep(3);
						$vk->sendMessage($peer_id, "|~Осознай свои грехи, вспомни~|");
						sleep(3);
						$vk->sendMessage($peer_id, "|~Стирать своё прошлое - ошибка~|");
						sleep(3);
						$vk->sendMessage($peer_id, "|~Осознай всё, ты близок~|");
						sleep(3);
						$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|> ************* |\/| |Осталось попыток|> $turn", [[]]);
						exit();
					}else{
						$story+=10;
						$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
						$vk->sendButton($peer_id, "//Вы должны взломать сервер//", [[]]);
						sleep(3);
						$vk->sendMessage($peer_id, "//Это последний слой//");
						sleep(3);
						$vk->sendMessage($peer_id, "//Вы обязательно справитесь//");
						sleep(3);
						$vk->sendMessage($peer_id, "||Сеть создана, подключение...||");
						sleep(2);
						$vk->sendButton($peer_id, "|Присутствуют буквы|> \n |Пароль|> ************* |\/| |Осталось попыток|> $turn", [[]]);
						exit();
					}
				}
			}
			if($d == 1){
				$word_g = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];
				$message = mb_strtoupper($message, 'UTF-8');
				$len_word = 13;
				$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];
				$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
				if (!(preg_match('/^[А-Я]++$/ui', $message))){
					$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
					exit();
				}
				if ((strlen($message))/2 > $shop_input){       
					$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
					exit();
				}
				$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
				$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY);
				$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
				$ar_word = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY);
				$have = '';
				$kk=0; 
				for ($i=0; $i<$shop_input; $i++){
					if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}
					if($ar_message[$i]==$ar_word[$kk]){
						if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];}
					}
					else{
						for ($k=0; $k<$len_word; $k++){
							if($ar_message[$i]==$ar_word[$k]){$have=$have.$ar_word[$k];}
						}
					}
					$word_see = implode("", $ar_word_see);
					$kk+=1;
				}
				if ($word_see == $word_g){
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
					$story+=10;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					if(($b==7)and($c==7)){
						$vk->sendButton($peer_id, "|Доступ разрешен|", [[$btn_m7b1]]);
						exit();
					}else{
						$vk->sendButton($peer_id, "|Доступ разрешен|", [[$btn_m7b2]]);
						exit();
					}
				}
				$turn = $turn-1;
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
				$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
				if ($turn == 0){
					$vk->sendMessage($peer_id, "|Потеря соединения...|");
					$story-=17;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					sleep(2);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
					$vk->sendMessage($peer_id, "|~Все это действительно было? Или это слишком реальный сон?~|");
					sleep(3);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[]]);
				exit();
			}
			if($d == 2){
				if($payload == 'btn_m7b1'){
					$story-=27;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$vk->sendButton($peer_id, "|~Да, вот так, вспомни всё~|", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "|~Ты был простым работником на корпорацию~|");
					sleep(3);
					$vk->sendMessage($peer_id, "|~У тебя была любящая жена, прекрасная дочь~|");
					sleep(3);
					$vk->sendMessage($peer_id, "|~Но что-то пошло не так, и ты совершил грех~|");
					sleep(3);
					$vk->sendMessage($peer_id, "|~Вскоре ты заперся в себе и стал ужасным человеком~|");
					sleep(4);
					$vk->sendMessage($peer_id, "|~И попал сюда, к нам, в тюрьму Фиолетовая Паутина~|");
					sleep(4);
					$vk->sendMessage($peer_id, "|~Мы ловим твое сознание, частицы тебя в паутину~|");
					sleep(3);
					$vk->sendMessage($peer_id, "|~А затем маринуем их, создавая невообразимые результаты~|");
					sleep(4);
					$vk->sendMessage($peer_id, "|~В итоге человек должен стать нормальным и осознать свои грехи~|");
					sleep(5);
					$vk->sendMessage($peer_id, "|~Но с тобой все было сложнее, и теперь наконец-то ты меня слышишь~|");
					sleep(5);
					$vk->sendMessage($peer_id, "|~Проснись окончательно, твоя жизнь не здесь, она вокруг тебя~|");
					sleep(5);
					$vk->sendMessage($peer_id, "|~Да, я говорю с тобой, оглянись: вот она жизнь~|");
					sleep(4);
					$vk->sendMessage($peer_id, "|~Да, она жестока и несправедлива, но ты часть её~|");
					sleep(4);
					$vk->sendMessage($peer_id, "|~Если хочешь сделать ее более хорошей, правильной, то тогда сам стань таким и делай правильные дела~|");
					sleep(7);
					$vk->sendMessage($peer_id, "|~Все мы - маленькая частица, но именно из таких частиц и состоит жизнь~|");
					sleep(6);
					$vk->sendMessage($peer_id, "|~Быть может она всего лишь иллюзия~|");
					sleep(3);
					$vk->sendMessage($peer_id, "|~А быть может просто сон...Слишком реальный сон...~|");
					sleep(4);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
				if($payload == 'btn_m7b2'){
					$story-=27;
					$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
					$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
					$vk->sendButton($peer_id, "//Вы попрощались с Марией//", [[]]);
					sleep(2);
					$vk->sendMessage($peer_id, "//Фиолетовая Паутина получила доступ к главному серверу//");
					sleep(4);
					$vk->sendMessage($peer_id, "//Теперь она имеет контроль над всем городом//");
					sleep(3);
					$vk->sendMessage($peer_id, "//Вы не знаете, стала ли лучше жизнь, но...//");
					sleep(3);
					$vk->sendMessage($peer_id, "//Вам кажется, что стоило поступить иначе//");
					sleep(3);
					$vk->sendMessage($peer_id, "//Вы закрываете глаза, представляя, что это сон...//");
					sleep(5);
					$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
					exit();
				}
			}
		}
		

	}
	//Сюжет================================================================
	//=================================================================
	
	//=================================================================
	//Игра против игрока ================================================================
	$stat = $db->query('SELECT stat FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['stat'];//Узнаем статус
	if ($stat == 2){ //Если 2, то это взлом игрока
		$message = mb_strtoupper($message, 'UTF-8'); //Делаем буквы в сообщении заглавными
		$word_g = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];//Узнаем загаданное слово
		$len_word = (strlen($word_g))/2;                                                                   //Узнаем его длину
		$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];//Узнаем слово, что видит игрок
		$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
		                                                         //Узнаем, сколько он купил увеличений ввода и добавляем 4 стандартные
		if (!(preg_match('/^[А-Я]++$/ui', $message))){//Если это что-то, что не русские буквы
			$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
			exit();
		}
		if ((strlen($message))/2 > $shop_input){//Если кол-во вводимых букв превышает допустимый ввод
			$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
			exit();
		}
		$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];//Узнаем сколько ходов у игрока 
		$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY); //Разбиваем видимое слово на массив
		$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY); //Разбивает с ообщение игрока на массив
		$ar_word = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY); //Развиваем загаданное слово на массив
		$have = '';                                            //Переменная, в которой будут буквы, которые есть в слове
		$kk=0;                                               //Вспомогательная переменная
		for ($i=0; $i<$shop_input; $i++){ 
			if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}//Если буква в массиве не является Буквой, то пропускаем эту итерацию
			if($ar_message[$i]==$ar_word[$kk]){                             //Если буква совпадает по месту 
				if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];} //Если в видимом слове * на месте, то заменяем на букву, чтобы игрок видел, что отгадал её
			}
			else{
				for ($k=0; $k<$len_word; $k++){
					if($ar_message[$i]==$ar_word[$k]){$have=$have.$ar_word[$k];} //Если буквы не совпадает по месту, но есть в слове, то пихаем ее в have
				}
			}
			$word_see = implode("", $ar_word_see); //Собираем видимое слово
			$kk+=1;
		}
		if ($word_see == $word_g){ //Если видимое слово такое же, что загаданное - игрок выиграл
			$vkfwd_id = $db->query('SELECT vkfwd_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['vkfwd_id'];//Узнаем айди игрока, которого ломали
			$time_hack = $time + 1800;                                                          //Ставим ему кулдаун на 30 минут от в злома
			$db->query('UPDATE users SET time_hack = ?i WHERE vk_id = ?i', $time_hack, $vkfwd_id);
			$vk->sendMessage($peer_id, "|Пароль|:$word_g");
			sleep(1);
			$vk->sendMessage($peer_id, "|Доступ разрешен|");
			$reward = $db->query('SELECT reward FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['reward'];//Узнаем награду
			$lost = ($reward-100);
			$vk->sendMessage($vkfwd_id, "Вы были взломаны! Потеряно: $lost р."); 
			$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
			$money = $money + $reward;
			$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id); //Даём награду игроку
			$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vkfwd_id)->fetch_assoc()['money'];
			$money = $money - ($reward-100);
			$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vkfwd_id);
			$vk->sendMessage($peer_id, "Вы провели успешный взлом и получили: $reward р.!");//Сбрасываем все до нуля, заканчивая взлом
			$db->query('UPDATE users SET stat = ?i,word_g = "?s",word_see = "?s",reward = ?i,turn = ?i,vkfwd_id = ?i WHERE vk_id = ?i',0,NULL,NULL,0,0,0,$vk_id);
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			exit();
		}
		$turn = $turn-1; //Отнимаем ход
		$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
		$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
		if ($turn == 0){                  //Если ходы закончились, то обнуляем все и говорим о провале
			$db->query('UPDATE users SET stat = ?i,word_g = "?s",word_see = "?s",reward = ?i,turn = ?i,vkfwd_id = ?i WHERE vk_id = ?i',0,NULL,NULL,0,0,0,$vk_id);
			$vk->sendMessage($peer_id, "|Потеря соединения...| \n У вас кончились попытки!");
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			exit();
		}
		$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[$btn_hack_stop]]);
		exit();
	}
	//Игра против игрока ==========================================================================
	//=================================================================
	
	//=================================================================
	//Настройки миссий==========================================
	if ($stat == 3){
		if ($mis[0] == 'С'){                    //Если первое, что ввел игрок C - это сюжет
			if (!(($mis[1]>0)and($mis[1]<8))) {    //Проверяем, чтобы второе, что ввел игрока были цифры от 1 до 7
				$vk->sendMessage($peer_id, "Такой миссии нет!");
				exit();
			}
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 6, $vk_id); //Ставим статус 6, тк это статус сюжетной миссии
			$turn = (($db->query('SELECT shop_hack FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_hack'])*2);
			$story = $db->query('SELECT story FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['story'];
			if ($mis[1] == '1'){
				$story+=1;
				$turn = $turn+9;
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', '******', $vk_id);
				$vk->sendButton($peer_id, " /|_|03.03.2047|_|\ ", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "Это ты, тот новенький в паутине?", [[$btn_m1b1], [$btn_mdisc]]);
			}
			if ($mis[1] == '2'){
				$story+=2;
				$turn = $turn+7;
				$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', '*****', $vk_id);
				$vk->sendButton($peer_id, " /|_|05.03.2047|_|\ ", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "Мария на связи, как ты? Отдохнул и готов к новому заданию?", [[$btn_m2b0], [$btn_mdisc]]);
			}
			if ($mis[1] == '3'){
				$story+=3;
				$turn = 0;
				$vk->sendButton($peer_id, " /|_|08.03.2047|_|\ ", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "Добрый день, надеюсь, готов к заданию?", [[$btn_m3b0], [$btn_mdisc]]);
			}
			if ($mis[1] == '4'){
				$story+=4;
				$turn = $turn+9;
				$vk->sendButton($peer_id, " /|_|08.03.2047|_|\ ", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "Мы подготовили всё. Что насчет тебя?", [[$btn_m4b0], [$btn_mdisc]]);
			}
			if ($mis[1] == '5'){
				$story+=5;
				$turn = 0;
				$vk->sendButton($peer_id, " /|_|09.03.2047|_|\ ", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "Второй слой подготовлен, а ты?", [[$btn_m5b0], [$btn_mdisc]]);
			}
			if ($mis[1] == '6'){
				$story+=6;
				$turn = 0;
				$vk->sendButton($peer_id, " _\_|1=.0z.20*99|_|s ", [[]]);
				sleep(1);
				$vk->sendButton($peer_id, " /|_|10.03.2047|_|\ ", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "Приём! Ты готов?", [[$btn_m6b0], [$btn_mdisc]]);
			}
			if ($mis[1] == '7'){
				$story+=7;
				$turn = $turn+9;
				$vk->sendButton($peer_id, " /|_|10.03.2047?|_|\ ", [[]]);
				sleep(2);
				$vk->sendButton($peer_id, "//Считаете ли вы себя готовым?//", [[$btn_m7b0], [$btn_mdisc]]);
			}
			$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
			$db->query('UPDATE users SET story = ?i WHERE vk_id = ?i', $story, $vk_id);
			exit();
		}
		if ($mis[0] == 'В'){ //В - это миссии типа Взлом
			if (!(($mis[1]>0)and($mis[1]<21))) { //Есть 1-20 миссии, ни больше, ни меньше
				$vk->sendMessage($peer_id, "Такой миссии нет!");
				exit();
			}
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 4, $vk_id);//Статус 4 - это взлом
			shuffle($arr_alf);                                                    //Мешаем массив букв
			$turn = (($db->query('SELECT shop_hack FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_hack'])*2);
			if ($mis[1] == '1'){
				$word = mb_substr(implode($arr_alf), 0, 4,'UTF-8');//Из массива выбираем 4 буквы, они и будут паролем
				$word_see = '****';                               //тк буквы 4, то звездочек тоже
				$reward = 100;                                    //Награда
				$turn = $turn+7;                                  //Ходы
				$mon = 0;                                         //Плата за начало миссии
			}
			if ($mis[1] == '2'){
				$word = mb_substr(implode($arr_alf), 0, 5,'UTF-8');
				$word_see = '*****';
				$reward = 150;
				$turn = $turn+7;
				$mon = 40;
			}
			if ($mis[1] == '3'){
				$word = mb_substr(implode($arr_alf), 0, 6,'UTF-8');
				$word_see = '******';
				$reward = 200;
				$turn = $turn+7;
				$mon = 60;
			}
			if ($mis[1] == '4'){
				$word = mb_substr(implode($arr_alf), 0, 7,'UTF-8');
				$word_see = '*******';
				$reward = 270;
				$turn = $turn+7;
				$mon = 80;
			}
			if ($mis[1] == '5'){
				$word = mb_substr(implode($arr_alf), 0, 8,'UTF-8');
				$word_see = '********';
				$reward = 330;
				$turn = $turn+7;
				$mon = 100;
			}
			if ($mis[1] == '6'){
				$word = mb_substr(implode($arr_alf), 0, 9,'UTF-8');
				$word_see = '*********';
				$reward = 400;
				$turn = $turn+7;
				$mon = 120;
			}
			if ($mis[1] == '7'){
				$word = mb_substr(implode($arr_alf), 0, 10,'UTF-8');
				$word_see = '**********';
				$reward = 450;
				$turn = $turn+7;
				$mon = 140;
			}
			if ($mis[1] == '8'){
				$word = mb_substr(implode($arr_alf), 0, 11,'UTF-8');
				$word_see = '***********';
				$reward = 530;
				$turn = $turn+7;
				$mon = 160;
			}
			if ($mis[1] == '9'){
				$word = mb_substr(implode($arr_alf), 0, 12,'UTF-8');
				$word_see = '************';
				$reward = 650;
				$turn = $turn+7;
				$mon = 180;
			}
			if ($mis[1] == '10'){
				$word = mb_substr(implode($arr_alf), 0, 13,'UTF-8');
				$word_see = '*************';
				$reward = 750;
				$turn = $turn+7;
				$mon = 200;
			}
			if ($mis[1] == '11'){
				$word = mb_substr(implode($arr_alf), 0, 4,'UTF-8');
				$word_see = '****';
				$reward = 120;
				$turn = $turn+2;                               //Тут усложненные миссии, меньше ходов
				$mon = 30;
			}
			if ($mis[1] == '12'){
				$word = mb_substr(implode($arr_alf), 0, 5,'UTF-8');
				$word_see = '*****';
				$reward = 200;
				$turn = $turn+2;
				$mon = 60;
			}
			if ($mis[1] == '13'){
				$word = mb_substr(implode($arr_alf), 0, 6,'UTF-8');
				$word_see = '******';
				$reward = 300;
				$turn = $turn+2;
				$mon = 90;
			}
			if ($mis[1] == '14'){
				$word = mb_substr(implode($arr_alf), 0, 7,'UTF-8');
				$word_see = '*******';
				$reward = 420;
				$turn = $turn+2;
				$mon = 120;
			}
			if ($mis[1] == '15'){
				$word = mb_substr(implode($arr_alf), 0, 8,'UTF-8');
				$word_see = '********';
				$reward = 550;
				$turn = $turn+2;
				$mon = 150;
			}
			if ($mis[1] == '16'){
				$word = mb_substr(implode($arr_alf), 0, 9,'UTF-8');
				$word_see = '*********';
				$reward = 700;
				$turn = $turn+2;
				$mon = 180;
			}
			if ($mis[1] == '17'){
				$word = mb_substr(implode($arr_alf), 0, 10,'UTF-8');
				$word_see = '**********';
				$reward = 850;
				$turn = $turn+2;
				$mon = 210;
			}
			if ($mis[1] == '18'){
				$word = mb_substr(implode($arr_alf), 0, 11,'UTF-8');
				$word_see = '***********';
				$reward = 1000;
				$turn = $turn+2;
				$mon = 240;
			}
			if ($mis[1] == '19'){
				$word = mb_substr(implode($arr_alf), 0, 12,'UTF-8');
				$word_see = '************';
				$reward = 1100;
				$turn = $turn+2;
				$mon = 270;
			}
			if ($mis[1] == '20'){
				$word = mb_substr(implode($arr_alf), 0, 13,'UTF-8');
				$word_see = '*************';
				$reward = 1200;
				$turn = $turn+2;
				$mon = 300;
			}
			$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
			if($money < $mon){                                                                              //Если у игрока нет хватает денег, отправляем в начало
				$vk->sendButton($peer_id, "На вашем счете мало средств для взлома!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
				$vk->sendMessage($peer_id, "Выполните миссию В 1, чтобы заработать деньги.");
				$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
				exit();
			}
			$pay = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-$mon);
			$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 4, $vk_id);            //Эту переменную будем прибавлять к допустимому вводу
			if($mis[1]>10){$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 1, $vk_id);}//Если миссии сложные, то добавим только 1, а не 4
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word, $vk_id);
			$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
			$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', $reward, $vk_id);
			$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
			$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $pay, $vk_id);
			$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[$btn_hack_stop]]);
			exit();
		}
		if ($mis[0] == 'П'){ //П - это превосходство, тут также 20 миссий
			if (!(($mis[1]>0)and($mis[1]<21))) {
				$vk->sendMessage($peer_id, "Такой миссии нет!");
				exit();
			}
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 5, $vk_id);
			shuffle($arr_alf);  
			shuffle($arr_alf2);   //Мешаем второй алфавит для бота
			$alf = implode($arr_alf2);//Собираем его в слово, бот будет брать буквы из этого слова для угадывания
			$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
			$len_word = (strlen($word))/2;
			$len_word_half = $len_word;//Если миссии будут сложные, то это переменная станет равна половине длины пароля
			$word_b = '';
			if($mis[1] == '1'){
				$word = mb_substr(implode($arr_alf), 0, 4,'UTF-8');
				$word_see = '****';
				$reward = 80;
			}
			if($mis[1] == '2'){
				$word = mb_substr(implode($arr_alf), 0, 5,'UTF-8');
				$word_see = '*****';
				$reward = 150;
			}
			if($mis[1] == '3'){
				$word = mb_substr(implode($arr_alf), 0, 6,'UTF-8');
				$word_see = '******';
				$reward = 220;
			}
			if($mis[1] == '4'){
				$word = mb_substr(implode($arr_alf), 0, 7,'UTF-8');
				$word_see = '*******';
				$reward = 300;
			}
			if($mis[1] == '5'){
				$word = mb_substr(implode($arr_alf), 0, 8,'UTF-8');
				$word_see = '********';
				$reward = 350;
			}
			if($mis[1] == '6'){
				$word = mb_substr(implode($arr_alf), 0, 9,'UTF-8');
				$word_see = '*********';
				$reward = 450;
			}
			if($mis[1] == '7'){
				$word = mb_substr(implode($arr_alf), 0, 10,'UTF-8');
				$word_see = '**********';
				$reward = 530;
			}
			if($mis[1] == '8'){
				$word = mb_substr(implode($arr_alf), 0, 11,'UTF-8');
				$word_see = '***********';
				$reward = 600;
			}
			if($mis[1] == '9'){
				$word = mb_substr(implode($arr_alf), 0, 12,'UTF-8');
				$word_see = '************';
				$reward = 700;
			}
			if($mis[1] == '10'){
				$word = mb_substr(implode($arr_alf), 0, 13,'UTF-8');
				$word_see = '*************';
				$reward = 800;
			}
			if($mis[1] == '11'){
				$word = mb_substr(implode($arr_alf), 0, 4,'UTF-8');
				$word_see = '****';
				$reward = 120;
			}
			if($mis[1] == '12'){
				$word = mb_substr(implode($arr_alf), 0, 5,'UTF-8');
				$word_see = '*****';
				$reward = 220;
			}
			if($mis[1] == '13'){
				$word = mb_substr(implode($arr_alf), 0, 6,'UTF-8');
				$word_see = '******';
				$reward = 310;
			}
			if($mis[1] == '14'){
				$word = mb_substr(implode($arr_alf), 0, 7,'UTF-8');
				$word_see = '*******';
				$reward = 420;
			}
			if($mis[1] == '15'){
				$word = mb_substr(implode($arr_alf), 0, 8,'UTF-8');
				$word_see = '********';
				$reward = 500;
			}
			if($mis[1] == '16'){
				$word = mb_substr(implode($arr_alf), 0, 9,'UTF-8');
				$word_see = '*********';
				$reward = 600;
			}
			if($mis[1] == '17'){
				$word = mb_substr(implode($arr_alf), 0, 10,'UTF-8');
				$word_see = '**********';
				$reward = 730;
			}
			if($mis[1] == '18'){
				$word = mb_substr(implode($arr_alf), 0, 11,'UTF-8');
				$word_see = '***********';
				$reward = 850;
			}
			if($mis[1] == '19'){
				$word = mb_substr(implode($arr_alf), 0, 12,'UTF-8');
				$word_see = '************';
				$reward = 1000;
			}
			if($mis[1] == '20'){
				$word = mb_substr(implode($arr_alf), 0, 13,'UTF-8');
				$word_see = '*************';
				$reward = 1110;
			}
			$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
			if($money < ((int)(($reward)/4))){
				$vk->sendButton($peer_id, "На вашем счете мало средств для взлома!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
				$vk->sendMessage($peer_id, "Выполните миссию В 1, чтобы заработать деньги.");
				$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
				exit();
			}
			if($mis[1] > 10){ //Если миссии от 11-20, то бот будет знать половину пароля игрока
				$len_word_half = ((int)($len_word/2));
				$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $len_word_half, $vk_id);
				$wordp = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
				$word_b = mb_substr($wordp, 0, $len_word_half,'UTF-8');
				$alf = preg_replace('/['.$word_b.']/ui', '', $alf);
				if(($len_word % 2) == 1){$len_word_half+=1;}
			}
			for ($i = 0; $i < $len_word_half ; $i++){$word_b = $word_b.'*';}//Создаем слово, что Видит бот, оно равно длине пароля, либо половине, если ему известна половина пароля
			$db->query('UPDATE users SET alf = "?s" WHERE vk_id = ?i', $alf, $vk_id);
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word, $vk_id);
			$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
			$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', $reward, $vk_id);
			$db->query('UPDATE users SET word_bot = "?s" WHERE vk_id = ?i', $word_b, $vk_id);
			$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|>$word_see /||\ |Ваш пароль|>$word_b", [[$btn_hack_stop]]);
			exit();
			}
		exit();
	}
	//Миссии типа ВЗЛОМ===============================================
	//=================================================================
	if ($stat == 4){ //Это основное действо во время миссий типа Взлом
		$word_g = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];
		$message = mb_strtoupper($message, 'UTF-8');
		$len_word = (strlen($word_g))/2;
		$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];
		$inp = $db->query('SELECT vkfwd_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['vkfwd_id']; //Это добавление к вводу, стандартно 4, но если сложная миссия, то 1
		$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+$inp;
		
		if (!(preg_match('/^[А-Я]++$/ui', $message))){
			$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
			exit();
		}
		if ((strlen($message))/2 > $shop_input){       
			$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
			exit();
		}
		$turn = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn'];
		$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY);
		$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
		$ar_word = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY);
		$have = '';
		$kk=0; 
		for ($i=0; $i<$shop_input; $i++){
			if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}
			if($ar_message[$i]==$ar_word[$kk]){
				if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];}
			}
			else{
				for ($k=0; $k<$len_word; $k++){
					if($ar_message[$i]==$ar_word[$k]){$have=$have.$ar_word[$k];}
				}
			}
			$word_see = implode("", $ar_word_see);
			$kk+=1;
		}
		if ($word_see == $word_g){ //Все почти также, как взлом с игроком, но некоторых строк нет, тк нет и игрока
			$vk->sendMessage($peer_id, "|Доступ разрешен|");
			$reward = $db->query('SELECT reward FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['reward'];
			$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
			$money = $money + $reward;
			$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id);
			$vk->sendMessage($peer_id, "Вы провели успешный взлом и получили: $reward р.!");
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			exit();
		}
		$turn = $turn-1;
		$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
		$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
		if ($turn == 0){
			$vk->sendMessage($peer_id, "|Секретное слово|:$word_g"); //Тк это не игрок, то можно показать, какое слово было
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', 0, $vk_id);
			$vk->sendMessage($peer_id, "|Потеря соединения...| \n У вас кончились попытки!");
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			exit();
		}
		$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[$btn_hack_stop]]);
		exit();
	}
	//Миссии типа ВЗЛОМ===============================================
	//=================================================================
	
	//=================================================================
	//Миссии типа ПРЕВОСХОДСТВО===============================================
	if ($stat == 5){
		$word_g = $db->query('SELECT word_g FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_g'];
		$message = mb_strtoupper($message, 'UTF-8');
		$len_word = (strlen($word_g))/2;
		$word_see = $db->query('SELECT word_see FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_see'];
		$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
		
		if (!(preg_match('/^[А-Я]++$/ui', $message))){
			$vk->sendMessage($peer_id, "Вы ввели недопустимые символы!");
			exit();
		}
		if ((strlen($message))/2 > $shop_input){
			$vk->sendMessage($peer_id, "Вы ввели недопустимое количество символов! \n Допустимое количество символов: $shop_input");
			exit();
		}
		$ar_word_see = preg_split('//u',$word_see,-1, PREG_SPLIT_NO_EMPTY);
		$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY);
		$ar_wordg = preg_split('//u',$word_g,-1, PREG_SPLIT_NO_EMPTY);
		$have = '';
		$kk=0; 
		//Программа игрока
		for ($i=0; $i<$shop_input; $i++){
			if(preg_match('/^[А-Я]++$/ui', @$ar_word_see[$kk])){$kk+=1; $i-=1; continue;}
			if($ar_message[$i]==$ar_wordg[$kk]){
				if ($ar_word_see[$kk] == '*'){$ar_word_see[$kk] = $ar_message[$i];}
			}
			else{
				for ($k=0; $k<$len_word; $k++){
					if($ar_message[$i]==$ar_wordg[$k]){$have=$have.$ar_wordg[$k];}
				}
			}
			$word_see = implode("", $ar_word_see);
			$kk+=1;
		}
		$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
		//Программа бота
		$word_b = $db->query('SELECT word_bot FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word_bot'];//Слово, которое Видит бот
		$pos = $db->query('SELECT vkfwd_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['vkfwd_id'];//Позиция, с которой надо начать брать буквы боту из алфавита
		$haveb = $db->query('SELECT have FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['have']; //Буквы, что Есть в слове
		$len = $db->query('SELECT turn FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['turn']; //Позволяет отслеживать, сколько буквы было угадано
		$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word']; //Загаданное слово, то есть пароль игрока
		$shop_word = (strlen($word))/2;
		$ar_word = preg_split('//u',$word,-1, PREG_SPLIT_NO_EMPTY);
		if ($len==$shop_word){                              //Если все буквы угаданы, то пора начинать их подставлять
			$k=0;
			$ar_word_b = preg_split('//u',$word_b,-1, PREG_SPLIT_NO_EMPTY);
			$ar_haveb = preg_split('//u',$haveb,-1, PREG_SPLIT_NO_EMPTY);
			shuffle($ar_haveb);                   //Мешаем буквы, что есть, в надежде угадать их места
			for ($i=0; $i<$shop_word; $i++){
				if($ar_word_b[$i] == '*'){      //Если буква в видимом слове - это *
					if($ar_haveb[$k]==$ar_word[$i]){//Сравнивает букву загаданного слова с тем, что подставляет бот
						$ar_word_b[$i] = $ar_haveb[$k]; //Подставляем вместо звездочки букву
						unset($ar_haveb[$k]);          //А саму букву удаляем из слова, что подставляет бот
					}
					$k+=1;
				}
			}
			$word_b = implode($ar_word_b);
			$haveb = implode($ar_haveb);
		}elseif($len<$shop_word){ //Если бот не узнал все буквы, то подставляет из алфавита по очереди
			$alf = $db->query('SELECT alf FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['alf'];
			$ar_word_b = preg_split('//u',$word_b,-1, PREG_SPLIT_NO_EMPTY);
			$mesb = mb_substr($alf, $pos, 4,'UTF-8');                 //pos показывает, с какой части надо забрать буквы, чтобы не брать одни и те же
			$ar_message = preg_split('//u',$mesb,-1, PREG_SPLIT_NO_EMPTY);
			$pos+=4; //Увеличиваем позицию
			$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', $pos, $vk_id);
			$kk=0;
			for ($i=0; $i<4; $i++){
				if(preg_match('/^[А-Я]++$/ui', @$ar_word_b[$kk])){$kk+=1; $i-=1; continue;}
				if($ar_message[$i]==$ar_word[$kk]){
					if ($ar_word_b[$kk] == '*'){$ar_word_b[$kk] = $ar_message[$i]; $len+=1;}
				}
				else{
					for ($k=0; $k<$shop_word; $k++){
						if($ar_message[$i]==$ar_word[$k]){$haveb=$haveb.$ar_word[$k]; $len+=1;}
					}
				}
				$word_b = implode($ar_word_b);
				$kk+=1;
			}
			$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $len, $vk_id);
		}
		$db->query('UPDATE users SET word_bot = "?s" WHERE vk_id = ?i', $word_b, $vk_id);
		$db->query('UPDATE users SET have = "?s" WHERE vk_id = ?i', $haveb, $vk_id);

		if ($word_see == $word_g){   //Если игрок угадал слово, то тоже самое, только еще обнуляем и данные бота
			$vk->sendMessage($peer_id, "|Доступ разрешен|");
			$reward = $db->query('SELECT reward FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['reward'];
			$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
			$money = $money + $reward;
			$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id);
			$vk->sendMessage($peer_id, "Вы провели успешный взлом и получили: $reward р.!");
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET alf = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET have = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET word_bot = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			exit();
		}
		if($word_b==$word){   //Если бот успел угадать слово, то обнуляем все 
			$vk->sendMessage($peer_id, "|Секретное слово|:$word_g");        //И забираем у игрока плату в размере 25% от награды
			$reward = ((int)(($db->query('SELECT reward FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['reward'])/4));
			$money = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-$reward);
			$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id);
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', 0, $vk_id);
			$db->query('UPDATE users SET alf = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET have = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$db->query('UPDATE users SET word_bot = "?s" WHERE vk_id = ?i', NULL, $vk_id);
			$vk->sendMessage($peer_id, "|Потеря соединения...| \n Вас взломали и вы потеряли: $reward р.");
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			exit();
		}
		$vk->sendButton($peer_id, "|Присутствуют буквы|>$have \n |Пароль|>$word_see /||\ |Ваш пароль|>$word_b", [[$btn_hack_stop]]);
		exit();
	}
	//Миссии типа ПРЕВОСХОДСТВО===============================================
	//=================================================================
	
	
	
	
	
	$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
	$shop_word = (($db->query('SELECT shop_word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_word'])+4);
	if ($word == "1"){                                 //Если пароль равен 1, то значит это фаза, когда игрок должен написать свой пароль
		$message = mb_strtoupper($message, 'UTF-8');
		if ((strlen($message))/2 > $shop_word){      //Проверяем, введеные пароль не превышает ли допустимую длину пароля
			$vk->sendMessage($peer_id, "Ваш пароль не соответствует длине!");
			exit();
		}
		if (preg_match('/^[А-Я]++$/ui', $message)){
			$ar_message = preg_split('//u',$message,-1, PREG_SPLIT_NO_EMPTY); //Разбивает слово на массив [0]=К [1]=Е [2]=К
			$ar_counts = array_count_values($ar_message); //Считает количество всех букв в массиве [К]=2 [Е]=1
			$flip = array_flip($ar_counts); //Меняет данные ключ и значение местами[2]=К [1]=Е
			foreach ($flip as $key => $value) { //Пробегает по массиву и ключ приравнивает к $key
				if ($key > 1) {                 //Проверка, есть ли ключ 2 и больше, если есть, значит эта буква повторялась
					$vk->sendMessage($peer_id, "В ващем пароле есть повторение символа!");
					exit();
				}
			}
			$db->query('UPDATE users SET word = "?s" WHERE vk_id = ?i',  $message, $vk_id); //Обновляем пароль
			$vk->sendMessage($peer_id, "Вы успешно изменили пароль!");
			$shop_word = (($db->query('SELECT shop_word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_word'])+4);
			$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
			$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i',  NULL, $vk_id);
			$vk->sendButton($peer_id, "Доступное число символом: $shop_word || Ваш пароль: $word", [[$btn_word_change], [$btn_begin]]);
			exit();
		} else {
			$vk->sendMessage($peer_id, "Ваш пароль не соответствует требованиям!");
			exit();
		}
	}

	
	
    if ($payload == 'btn_money'){ //Показывает деньги и купленные улучшения
		$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
		$shop_word = ($db->query('SELECT shop_word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_word'])+4;
		$shop_hack = (($db->query('SELECT shop_hack FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_hack'])*2)+7;
		$shop_input = ($db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'])+4;
		$vk->sendMessage($peer_id, "На вашем счету $money р. \n Допустимая длина пароля: $shop_word \n Доступно попыток при взломе: $shop_hack \n Допустимая длина вводимого слова: $shop_input");
		exit();
	}
	
    if ($payload == 'btn_shop'){ //Магазин
		$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
		$shop_word = $db->query('SELECT shop_word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_word'];
		$shop_hack = $db->query('SELECT shop_hack FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_hack'];
		$shop_input = $db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'];
		$word_price = (250*$shop_word)+100;
		$hack_price = (750*$shop_hack)+500;
		$input_price = (400*$shop_input)+250;
		if(($shop_word > 8)and($shop_hack > 8)and($shop_input > 8)){ //Если все улучшения = 9, то значит все куплено, тк максимум это 9
			$vk->sendButton($peer_id, "Увеличение длины пароля:ПРОДАНО \n Увеличение числа попыток:ПРОДАНО \n Увеличение длины вводимых символов:ПРОДАНО \n Случайная фраза: 100 р.", [[$btn_shop_fr], [$btn_begin]]);
			exit();
		}
		if($money < $word_price){$btn_shop_word = $vk->buttonText('+1 к допустимой длине пароля', 'red', ['command' => 'btn_shop_wordN']);} //Если у игрока не хватает денег на что-то, то окращиваем кнопки в красный
		if($money < $hack_price){$btn_shop_hack = $vk->buttonText('+2 попытки во время взлома', 'red', ['command' => 'btn_shop_hackN']);}    //И делаем их неработоспособными
		if($money < $input_price){$btn_shop_input = $vk->buttonText('+1 к длине вводимых символов', 'red', ['command' => 'btn_shop_inputN']);}
		if($money < 100){$btn_shop_fr = $vk->buttonText('Случайная фраза', 'red', ['command' => 'btn_shop_frN']);}
		
		if(($shop_word > 8)and($shop_hack > 8)){
			$vk->sendButton($peer_id, "Увеличение длины пароля:ПРОДАНО \n Увеличение числа попыток:ПРОДАНО \n Увеличение длины вводимых символов: $input_price р. \n Случайная фраза: 100 р.", [[$btn_shop_input], [$btn_shop_fr], [$btn_begin]]);
			exit();
		}
		if(($shop_word > 8)and($shop_input > 8)){
			$vk->sendButton($peer_id, "Увеличение длины пароля:ПРОДАНО \n Увеличение числа попыток: $hack_price р. \n Увеличение длины вводимых символов:ПРОДАНО \n Случайная фраза: 100 р.", [[$btn_shop_hack], [$btn_shop_fr], [$btn_begin]]);
			exit();
		}
		if(($shop_hack > 8)and($shop_input > 8)){
			$vk->sendButton($peer_id, "Увеличение длины пароля: $word_price р. \n Увеличение числа попыток:ПРОДАНО \n Увеличение длины вводимых символов:ПРОДАНО \n Случайная фраза: 100 р.", [[$btn_shop_word], [$btn_shop_fr], [$btn_begin]]);
			exit();
		}
		if($shop_input > 8){
			$vk->sendButton($peer_id, "Увеличение длины пароля: $word_price р. \n Увеличение числа попыток: $hack_price р. \n Увеличение длины вводимых символов:ПРОДАНО \n Случайная фраза: 100 р.", [[$btn_shop_word], [$btn_shop_hack], [$btn_shop_fr], [$btn_begin]]);
			exit();
		}
		if($shop_word > 8){
			$vk->sendButton($peer_id, "Увеличение длины пароля:ПРОДАНО \n Увеличение числа попыток: $hack_price р. \n Увеличение длины вводимых символов: $input_price р. \n Случайная фраза: 100 р.", [[$btn_shop_hack], [$btn_shop_input], [$btn_shop_fr], [$btn_begin]]);
			exit();
		}
		if($shop_hack > 8){
			$vk->sendButton($peer_id, "Увеличение длины пароля: $word_price р. \n Увеличение числа попыток:ПРОДАНО \n Увеличение длины вводимых символов: $input_price р. \n Случайная фраза: 100 р.", [[$btn_shop_word], [$btn_shop_input], [$btn_shop_fr], [$btn_begin]]);
			exit();
		}
		$vk->sendButton($peer_id, "Увеличение длины пароля: $word_price р. \n Увеличение числа попыток: $hack_price р. \n Увеличение длины вводимых символов: $input_price р. \n Случайная фраза: 100 р.", [[$btn_shop_word], [$btn_shop_hack], [$btn_shop_input], [$btn_shop_fr], [$btn_begin]]);
		exit();
	}
	if ($payload == 'btn_shop_fr'){ //Слуйная фраза, берем случайные слова и подставляем их в одну из фраз
		$money = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-100);
		$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id);
		$fr = mt_rand(1, 11); //"","","","","","","","","","","","","",""
		$arr_pri = array("адский", "прекрасный", "невероятный", "горячий","холодный","большой","маленький","крутой","острый","райский","сказочный","вкусный","чудовищный","королевский", //14
			"нетрадиционный","сладкий","длинный","грустный","молочный","горький","кислый","живой","сырный","абстрактный","агрессивный","безумный","лысый","горящий", // 28
			"бесконечный","пушистый","быстрый","обворожительный","грубый","злой","кричащий","ненасытный","преступный","пьянящий","сверхъестественный","свирепый","совершеннейший","щедрый"); // 42          
		$arr_su = array("торт", "человек", "мастер", "батон","хребет","голос","потенциал","корабль","компьютер","глаз","дух","друг","хитрец","банан", //14
			"огурец","француз","мексиканец","кот","пес","стул","шкаф","помидор","арбуз","гроб","чайник","багет","гриб","мёд", //28
			"сыр","туалет","огнетушитель","сервер","лобстер","краб","салат","чай","китаец","робот","пришелец","студент","школьник","танк"); //42
		$arr_gla = array("узнать","съесть","сломать","схватить","украсть","снять","обнять","забрать","приготовить","намочить","спасти","поздравить","взломать","похитить"); //14
		$i = mt_rand(0, 41);
		$pri = $arr_pri[$i];
		$i = mt_rand(0, 41);
		$pri1 = $arr_pri[$i];
		$i = mt_rand(0, 41);
		$su = $arr_su[$i];
		$i = mt_rand(0, 41);
		$su1 = $arr_su[$i];
		$i = mt_rand(0, 13);
		$gla = $arr_gla[$i];
		if($fr==1){$say = "Ты очень $pri человек!";}
		if($fr==2){$say = "Ты $su или даже два!";}
		if($fr==3){$say = "Ты абсолютно точно $pri $su";}
		if($fr==4){$say = "Тебе нравится $pri $su";}
		if($fr==5){$say = "Однажды тебя найдет $pri $su";}
		if($fr==6){$say = "В тебе есть $su";}
		if($fr==7){$say = "Хм, а $pri $su думает, что ты $pri1 $su1";}
		if($fr==8){$say = "Оу, $pri $su хочет тебя $gla";}
		if($fr==9){$say = "Думаю, что тебе нужно $gla что-нибудь";}
		if($fr==10){$say = "Вот это да, $su желает $gla $pri $su1";}
		if($fr==11){$say = "ВОУ! За твоей спиной $pri $su!";}
		$vk->sendButton($peer_id, "$say", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
		exit();
	}
	if ($payload == 'btn_shop_word'){//Покупка длины пароля
		$shop_word = $db->query('SELECT shop_word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_word'];
		$word_price = (250*$shop_word)+100;
		$money = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-$word_price);
		$shop_word+=1;
		$db->query('UPDATE users SET shop_word = ?i WHERE vk_id = ?i', $shop_word, $vk_id);
		$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id);
		$shop_word+=4;
		$vk->sendButton($peer_id, "Поздравляем! Теперь ваш пароль может состоять из $shop_word символов!", [[$btn_begin]]);
		exit();
	}
	if ($payload == 'btn_shop_hack'){//Покупка дополнительных попыток
		$shop_hack = $db->query('SELECT shop_hack FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_hack'];
		$hack_price = (750*$shop_hack)+500;
		$money = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-$hack_price);
		$shop_hack+=1;
		$db->query('UPDATE users SET shop_hack = ?i WHERE vk_id = ?i', $shop_hack, $vk_id);
		$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id);
		$vk->sendButton($peer_id, "Поздравляем! Теперь при взломе у вас на две попытки больше!", [[$btn_begin]]);
		exit();
	}
	if ($payload == 'btn_shop_input'){//Покупка длины ввода
		$shop_input = $db->query('SELECT shop_input FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_input'];
		$input_price = (400*$shop_input)+250;
		$money = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-$input_price);
		$shop_input+=1;
		$db->query('UPDATE users SET shop_input = ?i WHERE vk_id = ?i', $shop_input, $vk_id);
		$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $money, $vk_id);
		$shop_input+=4;
		$vk->sendButton($peer_id, "Поздравляем! Теперь при взломе вы можете ввести: $shop_input букв!", [[$btn_begin]]);
		exit();
	}
	if (($payload == 'btn_shop_wordN')or($payload == 'btn_shop_hackN')or($payload == 'btn_shop_inputN')or($payload == 'btn_shop_frN')){//Если нажата красная кнопка, то говорим, что нет денег
		$vk->sendMessage($peer_id, "У вас недостаточно средств для покупки!");
		exit();
	}
	
    if ($payload == 'btn_mission'){       //Кнопка миссий, меняет статус на 3, а также вызывает кнопки                        
		$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 3, $vk_id);
		$vk->sendButton($peer_id, "Вы должны ввести тип миссии(Сюжет-С/Взлом-В/Превосходство - П), а затем через пробел номер, например: 'В 1' и отправить.", [[$btn_mission_s, $btn_mission_v], [$btn_mission_z, $btn_begin]]);
		exit();
	}
	
    if ($payload == 'btn_hack'){ //Вызывает кнопки взлома человека
		$vk->sendButton($peer_id, "Вы можете взломать человека, чтобы украсть часть его средств! \n Доступен взлом случайного человека, либо определенного, чье сообщение сможете переслать.", [[$btn_hack_rand], [$btn_hack_det], [$btn_begin]]);
		exit();
		}
	
	if ($payload == 'btn_hack_rand'){ //Подготавливает все к взлому случайного человека
		$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
		if($money < 100){
			$vk->sendButton($peer_id, "На вашем счете мало средств для взлома!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			$vk->sendMessage($peer_id, "Выполните миссию В 1, чтобы заработать деньги.");
			exit();
		}
		$all = $db->query('SELECT COUNT(*) as count FROM users')->fetch_assoc()['count']; //Узнаем кол-во записей в БД
		$u_id = $db->query('SELECT user_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['user_id'];
		for($i=0;$i<11;$i++){ //Будет несколько раз пытаться найти невзломанного человека
			if($i > 9){
				$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id); //Если все, кто нам попались на кулдауне, то пишем, что не получилось найти никого
				$vk->sendMessage($peer_id,"Не удалось найти пользователя! \n Попробуйте еще раз через несколько минут");
				$vk->sendButton($peer_id, "Вы можете взломать человека, чтобы украсть часть его средств! \n Доступен взлом случайного человека, либо определенного, чье сообщение сможете переслать.", [[$btn_hack_rand], [$btn_hack_det], [$btn_begin]]);
				exit();
			}
			$rand_id = mt_rand(1, $all); //Выбираем случайное число
			if ($u_id == $rand_id){ //Если попался сам человек, то пропускаем итерацию
				continue;
			}
			$vkfwd_id = $db->query('SELECT vk_id FROM users WHERE user_id = ?i', $rand_id)->fetch_assoc()['vk_id'];
			$time_hack = $db->query('SELECT time_hack FROM users WHERE vk_id = ?i', $vkfwd_id)->fetch_assoc()['time_hack'];
			if (!($time_hack > $time)){ //Если у человека уже прошел кулдаун, то пропускаем цикл и идем дальше
				break;
			}
		}
		$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', $vkfwd_id, $vk_id);
		$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', 1, $vk_id);
		$vk->sendButton($peer_id, "Вы хотите взломать неизвестного человека? С вас спишется 150р.", [[$btn_hack_det_yes], [$btn_begin]]);
		exit();
	}
	
	if ($payload == 'btn_hack_det'){ //Делаем статус 1, когда надо переслать сообщение человека
		$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'];
		if($money < 150){
			$vk->sendButton($peer_id, "На вашем счете мало средств для взлома!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
			$vk->sendMessage($peer_id, "Выполните миссию В 1, чтобы заработать деньги.");
			exit();
		}
		$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 1, $vk_id);
		$vk->sendButton($peer_id, "Перешлите сообщение человека, которого хотите взломать. Если он не зарегистрирован, то вы не сможете его взломать.", [[$btn_begin]]);
		exit();
	}
	
	if ($payload == 'btn_hack_det_yes'){ //При согласии на взлом подготавливаем все к взлому
		$reward = $db->query('SELECT reward FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['reward'];
		$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 2, $vk_id);
		if ($reward == 1){                                             //Если награда 1, то это случайный взлом и плата меньше
			$pay = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-150);
		}else{$pay = (($db->query('SELECT money FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['money'])-250);}
		$db->query('UPDATE users SET money = ?i WHERE vk_id = ?i', $pay, $vk_id);
		$vkfwd_id = $db->query('SELECT vkfwd_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['vkfwd_id'];
		$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vkfwd_id)->fetch_assoc()['word'];
		$shop_word = (strlen($word))/2;
		$word_see = '';
		for ($i = 0; $i < $shop_word ; $i++){$word_see = $word_see.'*';} 
		$word_g = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vkfwd_id)->fetch_assoc()['word'];
		$money = $db->query('SELECT money FROM users WHERE vk_id = ?i', $vkfwd_id)->fetch_assoc()['money'];
		$reward = ((int)($money/ 10))+100;                //Берем 10% от суммы игрока, которого взламывают и еще прибавляем 100
		$turn = (($db->query('SELECT shop_hack FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_hack'])*2);
		$turn = $turn+7;
		$db->query('UPDATE users SET word_g = "?s" WHERE vk_id = ?i', $word_g, $vk_id);
		$db->query('UPDATE users SET word_see = "?s" WHERE vk_id = ?i', $word_see, $vk_id);
		$db->query('UPDATE users SET reward = ?i WHERE vk_id = ?i', $reward, $vk_id);
		$db->query('UPDATE users SET turn = ?i WHERE vk_id = ?i', $turn, $vk_id);
		$vk->sendButton($peer_id, "|Пароль|> $word_see |\/| |Осталось попыток|> $turn", [[$btn_hack_stop]]);
		exit();
	}
    if ($payload == 'btn_help'){ //Вызываем кнопки помощи
		$vk->sendButton($peer_id, "Если вы здесь впервые, то стоит начать с Как играть?", [[$btn_help_play, $btn_help_mission], [$btn_help_hack, $btn_help_word],[$btn_begin]]);
		exit();
	}
	//Туториал по игре
	if ($payload == 'btn_help_play'){ //Рассказывает, как играть, sleep, чтобы не вываливались сообщения моментом, а был ощущение, будто пишет человек
		$vk->sendButton($peer_id, "Приветствую в Фиолетовой Паутине!", [[]]);
		sleep(1);
		$vk->sendMessage($peer_id, "Меня зовут Тутори и я объясню, как здесь работает взлом, так... Пару секунд");
		sleep(4);
		$vk->sendMessage($peer_id, "Ага, вот и бумаги! Теперь мы можем идти дальше");
		sleep(3);
		$vk->sendMessage($peer_id, "Так вот, как только ты начнешь взлом тебе покажут Пароль, изначально он неизвестен и будет в виде звездочек, вот таких ****");
		sleep(6);
		$vk->sendMessage($peer_id, "Давай представим, что пароль - КОЛА ! Ах да, в любом пароле не может быть повторяющихся букв, КОЛА - может, КОКА - нет");
		sleep(6);
		$vk->sendMessage($peer_id, "Чтобы провести успешный взлом, тебе надо **** превратить в КОЛА, а чтобы уже это сделать нужно вводить комбинации букв!");
		sleep(6);
		$vk->sendMessage($peer_id, "Например АБВГ и после ввода тебе покажут, какие буквы есть в слове");
		sleep(3);
		$vk->sendMessage($peer_id, "При вводе АБВГ нам скажут, что в пароле присутствуют буква А и также мы понимаем, что букв Б, В и Г в пароле нет и можно сразу забыть о них!");
		sleep(7);
		$vk->sendMessage($peer_id, "Также если мы например введем ДЕЖА, то нам покажут уже не просто звездочки, а ***А");
		sleep(5);
		$vk->sendMessage($peer_id, "То есть было ****, мы ввели АБВГ, нам также показали **** и сказали, что А присутствует, мы ввели ДЕЖА, нам показали ***А!");
		sleep(6);
		$vk->sendMessage($peer_id, "И дальше это А никуда не исчезнет! Вот так мы и должны превратить звездочки в загаданный пароль");
		sleep(5);
		$vk->sendMessage($peer_id, "Но это еще не все! Нет нет! Суть в том, что пароли могут быть большей длины, например СОБАКИ");
		sleep(5);
		$vk->sendMessage($peer_id, "И в этом случае мы также может вводить только 4 буквы! Представляешь?");
		sleep(4);
		$vk->sendMessage($peer_id, "Все это из-за допустимой длины вводимых символов! По началу она равна 4, но потом в магазине можно будет ее увеличить!");
		sleep(6);
		$vk->sendMessage($peer_id, "Как будет работать взлом, когда ты можешь ввести 4, а пароль например из 6 букв? Все просто - угаданные буквы он не будет учитывать!");
		sleep(7);
		$vk->sendMessage($peer_id, "Вот например пароль СОБАКИ, ты угадал О, то есть покажут *О****, если ты введешь СБАК, то эти буквы подберутся к первой звездочке, и потом к 3,4 и 5");
		sleep(8);
		$vk->sendMessage($peer_id, "Тебе покажут СОБАК*, и дальше ты можешь ввести уже И, либо слово длинней");
		sleep(5);
		$vk->sendMessage($peer_id, "Но учти, что звездочка сравнивается с первым символом, то есть, если ты введешь ИРА, то угадаешь, но если РИС, то нет, так как проверяться будет буква Р, у нас же не СОБАКР");
		sleep(8);
		$vk->sendMessage($peer_id, "Давай приведу пример, как это будет");
		sleep(4);
		$vk->sendMessage($peer_id, "Пусть пароль будет СОБАКЕ");
		sleep(3);
		$vk->sendMessage($peer_id, "|Пароль|> ****** |\/| |Осталось попыток|> 42");
		sleep(1);
		$vk->sendMessage($peer_id, "СЕЫК");
		sleep(1);
		$vk->sendMessage($peer_id, "|Присутствуют буквы|>ЕК \n |Пароль|>С***** |\/| |Осталось попыток|>41");
		sleep(1);
		$vk->sendMessage($peer_id, "ОРАК");
		sleep(1);
		$vk->sendMessage($peer_id, "|Присутствуют буквы|> \n |Пароль|>СО*АК* |\/| |Осталось попыток|>40");
		sleep(1);
		$vk->sendMessage($peer_id, "ЯБЕ");
		sleep(1);
		$vk->sendMessage($peer_id, "|Присутствуют буквы|>БЕ \n |Пароль|>СО*АК* |\/| |Осталось попыток|>39");
		sleep(1);
		$vk->sendMessage($peer_id, "БЕ");
		sleep(1);
		$vk->sendMessage($peer_id, "|Доступ разрешен|");
		sleep(3);
		$vk->sendMessage($peer_id, "Вот и все! Надеюсь я тебе помогла!");
		sleep(3);
		$vk->sendMessage($peer_id, "А звали меня Тутори! На этом прощаюсь с тобой! Пока пока!");
		sleep(3);
		$vk->sendButton($peer_id, "Если вы здесь впервые, то стоит начать с Как играть?", [[$btn_help_play, $btn_help_mission], [$btn_help_hack, $btn_help_word],[$btn_begin]]);
		exit();
	}
	if ($payload == 'btn_help_mission'){
		$vk->sendButton($peer_id, "Что такое миссии?", [[]]);
		sleep(2);
		$vk->sendMessage($peer_id, "Миссии бывают трех типов, Сюжет, Взлом и Превосходство");
		sleep(3);
		$vk->sendMessage($peer_id, "Сюжет - это разнообразный взлом, вписанный в историю, также там учитывают купленные тобой попытки и длину ввода, а еще ты не получишь деньги там, но зато и не потеряешь");
		sleep(7);
		$vk->sendMessage($peer_id, "Взлом - это просто взлом случайного пароля, В 1 не требует платы, однако В 2 требует 40 р. для начала взлома, В 3 60 р. и так далее до В 10");
		sleep(5);
		$vk->sendMessage($peer_id, "В миссиях с 1 по 10 увеличивается длина пароля на букву,В 1 - 4 буквы, В 10 - 13 букв, с 11 до 20 также, В 11 - 4 буквы, В 20 - 13 букв");
		sleep(6);
		$vk->sendMessage($peer_id, "Однако В 11-20 сложнее, в них на 5 попыток меньше и вводимое слово на 3 буквы короче, а стоимость В 1 - 30 р., В 2 - 60 р. и так далее");
		sleep(6);
		$vk->sendMessage($peer_id, "Превосходство - Параллельный взлом с ботом, бот взламывает ваш пароль, а вы его, не беспокойтесь, боты разные, поэтому менять пароль нет необходимости");
		sleep(7);
		$vk->sendMessage($peer_id, "П 1-10 - обычные миссии, в них у бота нет преимущества, а П 11-20 - миссии, где боту открыта половина вашего пароля, небольшую сумму теряете лишь при проигрыше");
		sleep(7);
		$vk->sendMessage($peer_id, "Это все, что вам нужно знать о миссиях, помните, что В 1 всегда бесплатна, чтобы накопить начальный капитал!");
		sleep(5);
		$vk->sendButton($peer_id, "Если вы здесь впервые, то стоит начать с Как играть?", [[$btn_help_play, $btn_help_mission], [$btn_help_hack, $btn_help_word],[$btn_begin]]);
		exit();
	}
	if ($payload == 'btn_help_hack'){
		$vk->sendButton($peer_id, "Что же такое кража?", [[]]);
		sleep(2);
		$vk->sendMessage($peer_id, "Это взлом другого человека, чтобы украсть часть средств, вам доступен взлом случайного, либо определенного человека");
		sleep(5);
		$vk->sendMessage($peer_id, "Как только человек будет взломан, то на 30 минут он будет защищен от любого взлома, а также уведомлен о взломе");
		sleep(5);
		$vk->sendMessage($peer_id, "Случайный взлом дешевле, зато если есть возможность переслать сообщение человека, то можете взломать именно его!");
		sleep(5);
		$vk->sendMessage($peer_id, "Это все, что вам нужно знать о краже или же взлома человека, не пытайтесь взломать себя!");
		sleep(4);
		$vk->sendButton($peer_id, "Если вы здесь впервые, то стоит начать с Как играть?", [[$btn_help_play, $btn_help_mission], [$btn_help_hack, $btn_help_word],[$btn_begin]]);
		exit();
	}
	if ($payload == 'btn_help_word'){
		$vk->sendButton($peer_id, "Пароль?", [[]]);
		sleep(1);
		$vk->sendMessage($peer_id, "Да, вам нужен пароль, чтобы вас не взломал другой человек и не смог украсть часть средств");
		sleep(4);
		$vk->sendMessage($peer_id, "Любой пароль состоит из неповторяющихся русских букв, цифры и другие знаки запрещены");
		sleep(4);
		$vk->sendMessage($peer_id, "Также вы можете вводить буквы любого регистра, при взломе что абвг, что АБВГ - бот все одинаково засчитает");
		sleep(5);
		$vk->sendMessage($peer_id, "Это все, что вам нужно знать о пароле, помните, слова легче угадать, чем набор букв!");
		sleep(4);
		$vk->sendButton($peer_id, "Если вы здесь впервые, то стоит начать с Как играть?", [[$btn_help_play, $btn_help_mission], [$btn_help_hack, $btn_help_word],[$btn_begin]]);
		exit();
	}
    if ($payload == 'btn_word'){ //Вызывает кнопки для смена пароля, а также показываем его допустимую длину и сам пароль
		$shop_word = (($db->query('SELECT shop_word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['shop_word'])+4);
		$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
		$vk->sendButton($peer_id, "Доступное количество символов: $shop_word || Ваш пароль: $word", [[$btn_word_change], [$btn_begin]]);
		exit();
	}
    if ($payload == 'btn_word_change'){ //Сохраняет пароль в другой столбец, а сам пароль делает 1, грубо говоря ставит статус
		$vk->sendButton($peer_id, "Наберите набор русских, неповторяющихся букв доступной длины. Заглавная или нет - неважно, буква Ё - не доступна.", [[$btn_begin]]);
		$word = $db->query('SELECT word FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['word'];
		$db->query('UPDATE users SET word_g = "?s", word = "?s" WHERE vk_id = ?i', $word, "1", $vk_id);
		exit();
	}
	$stat = $db->query('SELECT stat FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['stat'];
	if ($stat == 1){                                                      //Если статус 1, то это фаза, когда игрока должен переслать сообщение
		$vkfwd_id = current($data->object->message->fwd_messages)->from_id; //Узнаем айди игрока через пересланное сообщение
		$id_reg_check = $db->query('SELECT vk_id FROM users WHERE vk_id = ?i', $vkfwd_id)->fetch_assoc()['vk_id']; //Проверяем, есть ли он в игре
		if (!$id_reg_check > 0) { //Если проверка покажет не больше нуля, то такого игрока нету в игре
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
			$vk->sendMessage($peer_id, "Такой человек не зарегистрирован в игре!");
			$vk->sendButton($peer_id, "Вы можете взломать человека, чтобы украсть часть его средств! \n Доступен взлом случайного человека, либо определенного, чье сообщение сможете переслать.", [[$btn_hack_rand], [$btn_hack_det], [$btn_begin]]);
			exit();
		}
		if ($vkfwd_id == $vk_id){ //Если айди игрока и айди пересланного игрока совпадают - это значит, что он переслал свое сообщение
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
			$vk->sendMessage($peer_id,"Вы не можете взломать себя! Ведь тогда вселенная схлопнется и вы не сможете продолжать играть в эту замечательную игру!");
			$vk->sendButton($peer_id, "Вы можете взломать человека, чтобы украсть часть его средств! \n Доступен взлом случайного человека, либо определенного, чье сообщение сможете переслать.", [[$btn_hack_rand], [$btn_hack_det], [$btn_begin]]);
			exit();
		}
		$time_hack = $db->query('SELECT time_hack FROM users WHERE vk_id = ?i', $vkfwd_id)->fetch_assoc()['time_hack'];//Узнаем кулдаун
		if ($time_hack > $time){                                                                        //Если его кулдаун еще не прошел, то не взламываем его
			$db->query('UPDATE users SET stat = ?i WHERE vk_id = ?i', 0, $vk_id);
            $vk->sendMessage($peer_id,"Пользователь уже взломан! \n Подключение недоступно!");
			$vk->sendButton($peer_id, "Вы можете взломать человека, чтобы украсть часть его средств! \n Доступен взлом случайного человека, либо определенного, чье сообщение сможете переслать.", [[$btn_hack_rand], [$btn_hack_det], [$btn_begin]]);
			exit();
		}
		$db->query('UPDATE users SET vkfwd_id = ?i WHERE vk_id = ?i', $vkfwd_id, $vk_id); //Если все в порядке, то пересылаем его айди в БД и спрашиваем игрока
		$userinfo = $vk->userInfo($vkfwd_id);
		$vk->sendButton($peer_id, "Вы хотите взломать: @id$vkfwd_id ($userinfo[first_name] $userinfo[last_name])? С вас спишется 250р.", [[$btn_hack_det_yes], [$btn_begin]]);
		exit();
	}
	
	if (($message == 'Начать')or($message == 'начать')) { //Главное слово, что позволяет новичкам начать играть, либо вернуться в начало
		$id_reg_check = $db->query('SELECT vk_id FROM users WHERE vk_id = ?i', $vk_id)->fetch_assoc()['vk_id'];//Пытаемся найти пользователя, что написал в БД
		if (!$id_reg_check > 0) { //Если его нет, то будет ноль, тогда добавляем запись в БД
			$db->query("INSERT INTO users (vk_id, money, word, shop_word, shop_hack) VALUES (?i, ?i, '?s', ?i, ?i)", $vk_id, 1000, "АБВГ", 0, 0);
			$vk->sendMessage($peer_id, "Вы успешно зарегистрированы в игре!");
			$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);
		} else {$vk->sendButton($peer_id, "Добро пожаловать в Фиолетовую Паутину!", [[$btn_money, $btn_shop], [$btn_mission, $btn_hack], [$btn_help, $btn_word]]);}//Если игрока уже есть, то просто даем кнопки начала
		exit();
    }

	if ($message == 'Отключить') //Это сообщение отключает кнопки, оно уже не нужно и о нем никто не должен знать
		$vk->sendButton($peer_id, "Кнопки скрыты, чтобы вызвать их - отправьте Начать", [[]]);
/*
define("SAMPLE_CONST", 2);
define("SAMPLE_CONST_2", 4);

if (($stat == SAMPLE_CONST)or($stat == SAMPLE_CONST_2)or

*/
}