<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HepsiSpace Yönetim</title>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <style>
        h2{
            font-size: 2.4rem;
            font-weight: bold;
        }
        h3{
            font-size: 1.2rem;
            font-weight: bold;
        }
        .flex{
            display: flex;
        }
        .mx-auto{
            margin: auto;
        }
        .container{
            width: 70rem;
            background: #ffeadd;
            padding: .5rem;
        }
        .rounded{
            border-radius: .3rem;
        }
        .w-full{
            width: 100%;
        }
        .text-center{
            text-align: center;
        }
    </style>
    <script>
        $(function(){
            $("#add").click(function(){
                $("#command").append($("#position").val());
            })

            $("#clear").click(function(){
                $("#command").html("");
            })

            $("#send").click(function(){
                $("#command_input").val($("#command").html());
                $("#command_form").submit();
            })
        })
    </script>
</head>
<body>
    <section>
        <h2 class="text-center">HepsiSpace Yönetim</h2>
        <div class="flex container mx-auto rounded">
            <div class="w-full">
                <h3 class="text-center">Kontrol Paneli</h3>
                <?php if(isset($_SESSION['start_vehicle']) && $_SESSION['start_vehicle'] == 1) { ?>
                    <div class="text-center">
                        <p>
                            <b>Cihaz :</b> <?php echo $_SESSION['vehicle_name']; ?>
                        </p>
                        <p>
                            <b>Başlangıç Yön :</b> <?php echo $_SESSION['vehicle_position']; ?>
                        </p>
                        <p>
                            <b>Başlangıç Koordinat :</b> <?php echo $_SESSION['vehicle_coordinate']['x'].' , '.$_SESSION['vehicle_coordinate']['y']; ?>
                        </p>

                        <p>
                            <b>Son Yön :</b> <?php echo $_SESSION['last_vehicle_position']; ?>
                        </p>
                        <p>
                            <b>Son Koordinat :</b> <?php echo $_SESSION['last_vehicle_coordinate']['x'].' , '.$_SESSION['last_vehicle_coordinate']['y']; ?>
                        </p>
                    </div>
                    <div class="text-center" id="control-panel">
                        <select name="position" id="position" required>
                            <option value="">Yön Seçiniz</option>
                            <option value="L">L ( Sol )</option>
                            <option value="R">R ( Sağ )</option>
                            <option value="M">M ( Sabit )</option>
                        </select>
                        <button type="button" id="add">Ekle</button>
                        <button type="button" id="send">Gönder</button>
                        <button type="button" id="clear">Temizle</button>
                        <a href="/vehicle/reset">Cihazı Sıfırla</a>
                    </div>
                    <form action="/vehicle/sendCommand" method="POST" id="command_form">
                        <input type="hidden" id="command_input" name="command_input">
                    </form>
                    <p id="command" class="text-center"></p>
                <?php } else { ?>
                    <form class="text-center" id="start" method="post" action="/vehicle/start">
                        <select name="start_position" id="start_position" required>
                            <option value="">Başlıngıç Yönü</option>
                            <option value="N">Kuzey ( N )</option>
                            <option value="S">Güney ( S )</option>
                            <option value="W">Batı ( W )</option>
                            <option value="E">Doğu ( E )</option>
                        </select>
                        <input type="number" step="1" name="x_coordinate" placeholder="X Koordinatı" required />
                        <input type="number" step="1" name="y_coordinate" placeholder="Y Koordinatı" required />
                        <button type="submit">Kontrolü Başlat</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </section>
</body>
</html>