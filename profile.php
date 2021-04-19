<?php
    session_start();

    if(isset($_SESSION['username']) && $_SESSION['username']!='' && $_SESSION['username']!=NULL) {

        if(isset($_POST['logout'])) {
            session_destroy();
            unset($_SESSION['username']);
            header('location:index.php');
        }

        $host='localhost';
        $user='root';
        $pass='';
        $dbname='toonindia';
        $conn=mysqli_connect($host,$user,$pass,$dbname);
        if(!$conn) {
            die("couldn't connect : ".mysqli_connect_error())."<br>";
        }

        $username = $_SESSION['username'];
        $sql = "SELECT * from toonusers where username='$username'";
        $result = mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($result);
    } else {
        header('location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>toonindia</title>
    <link 
     href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
     rel="stylesheet" 
     integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
     crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/contribution.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/faqs.css">
</head>
<body>
    <nav class="navbar navbar-expand navbar-fixed-top">
        <div class="container-fluid">
            <h4 id="logo">toonindia</h4>
            <ul class="nav navbar-nav justify-content-end">
                <li class="nav-item"><img src="<?php echo $data['profile']; ?>" alt="profile"></li>
                <li class="nav-item"><?php echo $data['username']; ?> <br><span><?php echo $data['id']; ?></span></li>
            </ul>
        </div>
    </nav>
    <div class="main">
        <div class="tab">
            <button onclick="window.location.href = 'index.php'">Home</button>
            <button class="tablinks" onclick="openCity(event, 'contribution')" id="defaultOpen">Contribution</button>
            <button class="tablinks" onclick="openCity(event, 'notification')">Notification</button>
            <button class="tablinks" onclick="openCity(event, 'invite')">Invite Friends</button>
            <button class="tablinks" onclick="openCity(event, 'setting')">Settings</button>
            <form action="" method="POST"><button type="submit" name="logout">Logout</button></form>
            <button class="tablinks" onclick="openCity(event, 'qna')">QnA</button>
        </div>
        <div id="contribution" class="tabcontent">
            <div class="mywork">
                <div class="tab2">
                    <button class="tablinks2" onclick="openType(event, 'Novels')" id="defaultOpen2">Novels</button>
                </div>
                <div id="Novels" class="tabcontent2">
                    <div>
                        <button class="new" onclick="window.location.href = 'newNovel.php'"><span>Add new Novel</span></button>
                    </div>
                    <div class="my" id="myNovels">
                        <div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="notification" class="tabcontent">
            <p>Notifications</p>
        </div>
        <div id="invite" class="tabcontent">
            <p>Invite Friends</p>
        </div>
        <div id="setting" class="tabcontent">
            <div class="container">
                <div class="main">
                    <h1> Edit Profile</h1>
                </div>
                <hr>
                <div class="inner-div-pic">
                    <div class="profile-pic">
                        <img id="output" alt="cover-photo">
                    </div>
                    <div class="info-pic">
                        <p><span style="font-weight: bold;">Profile Photo</span><br>
                            Accepted file type .png, .jpeg Less than 1MB
                        </p>
                        <input type="file" accept="image/*" name="cover" id="cover" onChange="loadFile(event)">
                        <button class="upload-btn"> Upload </button>
                    </div>
                </div>
                <hr>
                <div class="personal-details">
                    <h3 style="text-align: left; margin-left: 20px; padding-top: 2%;">Edit Personal Details</h3>
                    <div class="form-personal">
                        <input type="text" placeholder="Name" class="un"><br><br>
                        <input type="email" placeholder="Email" class="un"><br><br>
                        <input type="phone" placeholder="Phone Number" class="un"><br><br>
                    </div>
                </div>
                <hr>
                <div class="account-details">
                    <h3 style="text-align: left; margin-left: 20px; padding-top: 2%;">Edit Account Details</h3>
                    <div class="form-account">
                        <input type="text" placeholder="Username" class="un"><br><br>
                        <input type="password" placeholder="Old Password" class="un"><br><br>
                        <input type="password" placeholder="New Password" class="un"><br><br>
                        <input type="password" placeholder="Confirm Password" class="un"><br><br>
                    </div>
                </div>
                <div class="btns">
                    <div class="save">
                        <button onclick="window.location.href = 'profile.php'" class="save-btn">Save</button>
                    </div>
                    <div class="cancel">
                        <button onclick="window.location.href = 'profile.php'" class="cancel-btn">Cancel</button>
                    </div>
                </div>
                <hr>
                <div class="deactivate">
                    <p class="deactive-p"> <span style="font-weight: bold;"> Deactivate your account</span><br>
                        Details about your company account and password</p>
                    <button class="deactive-btn">Deactivate</button>
                </div>
            </div>
        </div>
        <div id="qna" class="tabcontent">
            <div class="faq">
                <h2>Author QAs</h2>
                <p>
                    Hello, dear friends, it has been a long time since the launch of MangaToon novel zone. At present, a large number of works have been published on MangaToon and won a large number of fans' support, for which we are deeply grateful.<br>
                    During the communication with the authors, we found some questions need to be cleared, and we will list the common problems one by one for you to review.
                </p>
                <button class="accordion"><b>1. What are the requirements for publishing a novel on MangaToon?</b></button>
                <div class="panel">
                    <p>
                        First of all, your work must be original and not copied from others. Temporarily the translation works are not accepted.<br>
                        Secondly, do not publish content that is too obscene, violent, or affects any national or religious interests.
                    </p>
                </div>
                <br>
                <button class="accordion"><b>2. About audit</b></button>
                <div class="panel">
                    <p>
                        After the creation of the work, you should add chapters as soon as possible. Works with chapters will get the review earlier.
                    </p>
                </div>
                <br>
                <button class="accordion"><b>3. Must it be a finished work?</b></button>
                <div class="panel">
                    <p>
                        We welcome serial works as well. MangaToon is eager to grow with you.
                    </p>
                </div>
                <br>
                <button class="accordion"><b>4. How to report problems in a novel? (illegal content, cover, plagiarism, etc.)</b></button>
                <div class="panel">
                    <p>
                        The Report can be submitted at the bottom of the description page. Once verified, editors will immediately deal with the work.
                    </p>
                </div>
                <br>
                <button class="accordion"><b>5. How to get the opportunity to show on the homepage</b></button>
                <div class="panel">
                    <p>
                        Maintain a steady update will help you gain popularity and recommendations.
                    </p>
                </div>
                <br>
                <button class="accordion"><b>6. How to apply for a contract?</b></button>
                <div class="panel">
                    <p>
                        Please go to the MangaToon official website to apply for a contract. Currently , any author who has publishes more than 20 chapters can apply for a contract. We will review the work after receiving the application. After that, we will contact you and discuss the details about the contract.
                    </p>
                </div>
                <br>
                <button class="accordion"><b>7. Is it true that publishing a novel on MangaToon will generate revenue?</b></button>
                <div class="panel">
                    <p>
                        Of course it’s true. MangaToon will give real money to reward the author. As long as your work is read, you will have income. And you can find your income information on toonindia's official website.
                    </p>
                </div>
                <br>
                <button class="accordion"><b>8. How do I draw my income</b></button>
                <div class="panel">
                    <p>
                        Fill in the receiving account information on the website, and MangaToon will give you the payment when the withdrawal standard is reached!
                    </p>
                </div>
                <br>
                <h3>Release novels on MangaToon and create new possibilities for your work.</h3>
                <p>We have created a character image for signed works, and there will be comic stories online later, please stay tuned!!!</p>
                <br>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/profile.js"></script>
    <script type="text/javascript" src="js/contribution.js"></script>
    <script src="js/viewImage.js"></script>
    <script src="js/faqs.js"></script>
</body>
</html>