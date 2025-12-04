<?php 
if (isset($_SESSION['message'])):
    $message = htmlspecialchars($_SESSION['message']);
?>
    <div id="Alert">
        <?= $message; ?>
        <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>

    <style>
        #Alert {
            background-color: #ffd700; 
            color: black;            
            border: 1px solid #ffeeba;
            padding: 12px 16px;
            border-radius: 6px;
            margin: 15px auto;
            max-width: 500px;
            font-size: 15px;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        #Alert .close-btn {
            position: absolute;
            right: 10px;
            top: 5px;
            cursor: pointer;
            color: #856404;
            font-weight: bold;
            font-size: 20px;
            transition: 0.2s;
        }

        #Alert .close-btn:hover {
            color: #000;
        }
    </style>
<?php
    unset($_SESSION['message']);
endif;
?>