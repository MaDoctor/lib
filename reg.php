<?php
    require 'bd.php';
?>
<!--
<?
if (isset($_POST['name']))//запрос на поиск жанра
{
    $name=$_POST['name'];
    ?>
    <style>
        #sortable {list-style-type: none;    overflow:auto; height: 800; padding-left: 10px;padding-top: 10px;


            -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 50px transparent, inset 0 0 20px rgb(0, 0, 0);
            border-radius: 10px;
        }
        #sortable li { border: 1px solid #000000;border-radius: 10px;
            -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 50px transparent, inset 0 0 10px rgb(0, 0, 0);
            margin: 4px;
            padding: 4px;
            padding-top: 0px;

            -moz-transition: all .5s linear;
            -o-transition: all .5s linear;
            -webkit-transition: all .5s linear;
        }

        #sortable li p{
            font-size: 12px;
            font-style: italic;

            -moz-transition: all .5s linear;
            -o-transition: all .5s linear;
            -webkit-transition: all .5s linear;
        }

        #sortable li div.p_div{
            height: 80px;
            background-color: rgba(217, 157, 48, 0.51);
            border-radius: 10px;
            padding: 10px;
            padding-top: 0px;

            margin-right: 10px;
            margin-left: 10px;

            -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 50px transparent, inset 0 0 9px rgb(0, 0, 0);

            border: 1px solid black;

            -moz-transition: all .5s linear;
            -o-transition: all .5s linear;
            -webkit-transition: all .5s linear;

            overflow: auto;
        }

        p.about{
            word-wrap: break-word;
        }

        button{

            background-color: rgba(2, 91, 0, 0.44);
            border: 1px solid #000000;
            border-radius: 5px;

            text-align: center;
            width: 100px;

            -moz-transition: all .5s linear;
            -o-transition: all .5s linear;
            -webkit-transition: all .5s linear;


            -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), inset 0 0 50px rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 50px transparent, inset 0 0 10px rgb(0, 0, 0);
        }



        img{
            width: 50;
        }



        #sortable li table{
            margin: 20px;
            margin-bottom: 0px;

        }

    </style>

    <script>
        $(function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        });

        var book='';
        function read(v){
            book=v;
            $.ajax({
                type: 'POST',
                url:  'reading.php',
                data: 'book_name='+ v,
                success: function(html)
                {
                    $('div.text2').empty();
                    $('div.text2').append(html);
                    // $('#messages').scrollTop(90000);
                }
            });
        }
    </script>
    <ul id="sortable">
    <?



    for($i=0;$i<v;$i++)
    {
        echo("<li>
        <table>



        <tr><td rowspan='3'> <img src='book.png'></td><td colspan='2'><p>Название: Восстание девяти</p></td><td  class='button'><button class='read' onclick=read('book')>Читать</button></td></tr>
        <tr><td colspan='2'><p>Автор:  Питтакус Лор</p></td><td class='button'><button class='download'>Скачать</button></td></tr>
        <tr><td colspan='2'><p>Колво. стр.: 145</p></td></tr>
        </table>

        <div class='p_div'><p class='about'>
        «ВосстаниеДевяти», третий том бестселлера Нью-ЙоркТаймс «Я — четвертый», ставки выше, чем когда-либо. Джон, шестая и другие уже известные вам лориенцы отчаянно пытаютсянайти остальных гвардейцев,пока не стало слишкомпоздно. Данная книга повествует о приключениях Джона Смита — Четвёртом члене лориенской гвардии и о Девятом, спасённом из базы могадорцев в конце второй книги — «Сила шести». А также о приключениях других гвардейцах: Шестой, Марины (Седьмой), Эллы (Десятой), Восьмого. Повествование в книги ведется поочередно от лица Джона Смита, Шестой и Марины. Вы узнаете о пророчестве на ход войны Лориена и Могадора. Большинство гвардейцев воссоединятся для борьбы против могадорцев и встретятся с их предводителя Сетракусом Ра. Раскроется заговор между правительством США и могадорцами. А Джон наконец узнает правду о Саре и… предательстве.

     События, описанные в этой книге — реальность. Некоторые имена, названия, местности в книгах серии умышленно изменены, ведь другие цивилизациисуществуют и некоторые из нихстремятся уничтожитьвас…


        </p>

        </div>

        </li>");
    }
    echo("</ul>");
}
else{
//тело сайта
    ?>

    <DOCTYPE html> -->
    <html>
    <head>

        <script type="text/javascript" src="./jquery.js"></script>
        <script type="text/javascript" src="./jquery-1.2.6.min.js"></script>
        <script type="text/javascript" src="./jquery-ui.js"></script>

        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="reg.css">



    <!--
       <! <style>
            div.main{
                background-color: gray;
                position: absolute;
                top:20px;
                left:300px;
                height: 700px;

                width:762px;

                border-radius: 10px;



                padding-left: 0px;

                -moz-transition: all .5s linear;
                -o-transition: all .5s linear;
                -webkit-transition: all .5s linear;




                border: 1px solid black;

            }

            ul.left{
                position: fixed;
                top:20px;
                left: 0px;
                width: 300px;
                height: 400px;

                list-style-type: none;
            }



        </style> -->
    </head>
    <!-- <script>

        function vivod_tuda(str){
            document.writeln("<table><tr>");
            for (i=0;i<str.length;i++){
                document.writeln('<td width=14 height=10><a class="silkalf" href="index.php">'+str.charAt(i)+"</a></td>");
                if (str.charAt(i+1)=="А")
                    document.writeln("</tr><tr>");
            }	document.writeln("</tr></table>");
        }

        function download_ganr(v){
            $.ajax({
                type: 'POST',
                url:  'index.php',
                data: 'name='+ v,
                success: function(html)
                {
                    $('div.text2').empty();
                    $('div.text2').append(html);
                    // $('#messages').scrollTop(90000);
                }
            });
        }



    </script> -->
  <body background="obo.png">
 <div class="main"><div>
 <div><p class="avt" align=center> РЕГИСТРАЦИЯ</p>
 <p class="avt1" align=center>Для коректной регистрации обязательно введите двнные помеченые " <h class="zvez">*</h> ".</p>
 </div>
 <br>
</div></div>
<div class="Ramka" >
 <div class="page" >

    <div class="box3" align=center>
	<a class="gl" href="index.php" >
	<p>GrandLibOd.ua</p></a>
    </div>
	<div class="box4">
			<div class="rightwin">
			<form name='F1' method='POST' action='search.php'>
				<input class="vvod" type='text' name='login' size="20" maxlength="32" placeholder="Логин" onblur="if(this.value=='')this.placeholder='Логин'"> <br><br>
				<input class="vvod" type='password' name='password' size="20" maxlength="32" placeholder="Пароль" onblur="if(this.value=='')this.placeholder='Пароль'"><br><br>
				<input class="kn_poisk" type='submit' value='Вход'>
			</form>
		</div>
		<span id="error" class=""></span>
		<div class="leftwin">
			<div class="our_poisk">
				<form name='F1' method='POST' action='search.php'>
					<input class="poisk" type='text' name='poisk'>
					<input class="kn_poisk" type='submit' value='Поиск'>
				</form>
			</div>
			<div class="ganri" align=left>
				<p class="text">
				<b>Жанры</b> </p>
					<ul class="catalogueList">
					<li>
                        <a class="silk" onclick=download_ganr('Roman')> <p>Роман</p> </a>
					</li>
					<li>
					<a class="silk" href="Index1en.html"> <p>Военное дело</p> </a>
					</li>
					<li>
					<a class="silk" href="Index1en.html"> <p>Деловая литература</p> </a>
					</li>
					<li>
					<a class="silk" href="Index1en.html"> <p>Детективы и Триллеры</p> </a>
					</li>
					<li>
					<a class="silk" href="Index1en.html"> <p>Детское</p> </a>
					</li>
					<li>
					<a class="silk" href="Index1en.html"> <p>Документальная литература</p> </a>
					</li>
					<li>
					<a class="silk" href="Index1en.html"> <p>Домоводство (Дом и семья)</p> </a>
					</li>
					<li>
					<a class="silk" href="Index1en.html"> <p>Драма</p> </a>
					</li>
					<li>
					<a class="silk" href="Genres.html"> <p>Все жанры</p> </a>
					</li>
					</ul>
				</div>
		</div>
        <div class="alfav">
            <p class="avt"> ПО ФАМИЛИИ АВТОРА:
                <script>
                    vivod_tuda("АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ");
                    function vivod_tuda(str){
                        document.writeln("<table><tr>");
                        for (i=0;i<str.length;i++){
                            document.writeln('<td width=14 height=10><a class="silkalf" href="Index1en.html">'+str.charAt(i)+"</a></td>");
                            if (str.charAt(i+1)=="А")
                                document.writeln("</tr><tr>");
                        }	document.writeln("</tr></table>");
                    }
                </script>
            </p>

            <p class="avt"> ПО НАЗВАНИЮ КНИГИ:
                <script>
                    vivod_tuda("АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ");
                </script>
            </p>
        </div>

		 <script type="text/javascript">
		  $(document).ready(function(){

				var od = $("go");

				go.click(function()
				 {
				 $Login = $_REQUEST['first_name'];
				 $firstName = $_REQUEST['first_name'];
}                $lastName = $_REQUEST['last_name'];
                 $email = $_REQUEST['email'];
                 $password = $_REQUEST['password'];
                 $repassword = $_REQUEST['repassword'];

                 $insert_sql = "INSERT INTO users (first_name, last_name, email, facebook)" .
                 "VALUES('{$first_name}', '{$last_name}', '{$email}', '{$facebook}');";
                 mysql_query($insert_sql);



			}
			);
		 </script>
		 <br>
        <div class="leftreg" align=center>
				<div><input id="login" class="vvod" type="text" name="Login" size="30" maxlength="32" placeholder="Логин" onblur="if(this.value=='')this.placeholder='Введите Логин'"></p></div><h class="zvez1">*</h><br><br>
				<div><input id="firstname" class="vvod" type="text" name="firstName" size="30" maxlength="32" placeholder="Имя" onblur="if(this.value=='')this.placeholder='Введите Имя'"></p></div><br><br>
				<div><input id="lastname" class="vvod" type="text" name="lastName" size="30" maxlength="32" placeholder="Фамилия" onblur="if(this.value=='')this.placeholder='Введите Фамилию'"></p></div><br><br>
				<div><input id="e-mail" class="vvod" type="text" name="email" size="30" maxlength="32" placeholder="E-mail" onblur="if(this.value=='')this.placeholder='Введите e-mail'"></p></div><h class="zvez1">*</h><br><br>
				<div><input id="pass" class="vvod" type="password" name="password" size="30" maxlength="32" placeholder="Пароль" onblur="if(this.value=='')this.placeholder='Введите пароль'"></p></div><h class="zvez1">*</h><br><br>
				<div><input id="repass" class="vvod" type="password" name="repassword" size="30" maxlength="32" placeholder="Повторите пароль" onblur="if(this.value=='')this.placeholder='Введите пароль'"></p></div><h class="zvez1">*</h><br><br><br>

				<div class="r2">
				<p class="avt"> Дата рождения:</p>
				<select class="vvod">
						<option class="vvod">Год</option>
						<option class="vvod">1980</option><option class="vvod">1981</option><option class="vvod">1982</option><option class="vvod">1983</option>
						<option class="vvod">1984</option><option class="vvod">1985</option><option class="vvod">1986</option><option class="vvod">1987</option>
						<option class="vvod">1988</option><option class="vvod">1989</option><option class="vvod">1990</option><option class="vvod">1991</option>
						<option class="vvod">1992</option><option class="vvod">1993</option><option class="vvod">1994</option><option class="vvod">1995</option>
						<option class="vvod">1996</option><option class="vvod">1997</option><option class="vvod">1998</option><option class="vvod">1999</option>
						<option class="vvod">2000</option><option class="vvod">2001</option><option class="vvod">2002</option><option class="vvod">2003</option>
						<option class="vvod">2004</option><option class="vvod">2005</option><option class="vvod">2006</option><option class="vvod">2007</option>
						<option class="vvod">2008</option><option class="vvod">2009</option><option class="vvod">2010</option><option class="vvod">2011</option>
						<option class="vvod">2012</option><option class="vvod">2013</option><option class="vvod">2014</option>
					 </select >
					 <select class="vvod">
						<option class="vvod">Месяц</option>

					 </select>
					 <select class="vvod2">
						<option class="vvod">День</option>
						<option class="vvod">1</option>
						<option class="vvod">22</option>
					 </select>
					 </div><br><br><br>
				<div class="r1">
				<p class="avt" align=left> Пол:
				   <select class="vvod3" >
				   <option class="vvod">Женский</option>
				   <option class="vvod">Мужской</option>
				</p>
				   </select >
				</div>
				<div class="r3">
					<script type="text/javascript" language="javascript">
						function valid(){ // Функция вывода картинки
						var v=new Array; // Объявляем массив
						v[0]="13.bmp"; // Заполняем массив именами наших файлов
						v[1]="47.bmp";
						v[2]="68.bmp";
						v[3]="91.bmp";

						now=new Date();
						num=(now.getSeconds())%v.length;
						document.write('<img name="pic" src="'+v[num]+'"></img>');
						// Ввыводим случайную картинку
						}
						function check(){ // Функция проверки
						var sp=document.form1.pic.src.split('/'); // Получаем полное имя файла
						var sp2=sp[sp.length-1].split('.');
						// Получаем только имя без расширения файла
						var sp3=sp2[0]+"64"; // Получаем код на картинке
						if(document.form1.valid.value==sp3)
						{
							t=document.getElementById("go");
							t.style.display="block";
							$("#error").text("Код введен правильно!").removeClass("error").addClass("success").show().delay
							(2000).fadeOut(300);
						} else {
						    	$("#error").text("Неправилно введен код!").removeClass("success").addClass("error").show().delay
								(2000).fadeOut(300);
							}
						}
					</script>
					<h class="zvez1">
					<form name="form1" action="" method="">
					<p class="avt"> Введите код:</p>*</h>
					<script>valid();</script>
					<div class="r31">
					<input type="text" name="valid" maxlength="4" size="6">
					<input type="button" value="Далее" onclick="check();">
					</form>
					<div><input id="go" class="go" type="button" style="display:none" value="Зарегистрироваться"></input></div>
					</div>
				</div>
			</div>
		</div>


	</div>
  </div>
  </div>
 </body>
</html>
    <?}?>