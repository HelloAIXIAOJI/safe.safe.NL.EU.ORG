<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站申请表单</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 收集表单数据
    $websiteName = $_POST["websiteName"];
    $websiteDomain = $_POST["websiteDomain"];
    $websiteHomepage = $_POST["websiteHomepage"];
    $owner = $_POST["owner"];
    $email = $_POST["email"];

    // 创建文件路径
    $filePath = "review/{$websiteName}.datxtreview";

    // 创建文件内容
    $fileContent = "新的申请：" . date("Y-m-d H:i:s") . "，申请IP：" . $_SERVER['REMOTE_ADDR'] . "\n";
    $fileContent .= "网站名称：{$websiteName}\n";
    $fileContent .= "网站域名：{$websiteDomain}\n";
    $fileContent .= "网站首页：{$websiteHomepage}\n";
    $fileContent .= "网站拥有：{$owner}\n";
    $fileContent .= "电子邮箱：{$email}\n";

    // 写入文件
    file_put_contents($filePath, $fileContent);

    // 提示信息
    echo "<div class='message'>你的请求已提交，请在未来几天关注电子邮件</div>";
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="websiteName">网站名称：</label>
    <input type="text" name="websiteName" required>

    <label for="websiteDomain">网站域名：</label>
    <input type="text" name="websiteDomain" required>

    <label for="websiteHomepage">网站首页：</label>
    <input type="text" name="websiteHomepage" required>

    <label for="owner">拥有人（公司）：</label>
    <input type="text" name="owner" required>

    <label for="email">电子邮箱：</label>
    <input type="email" name="email" required>

    <input type="submit" value="提交">
</form>

</body>
</html>
