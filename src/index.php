<?php
    require_once('parsedown/Parsedown.php');
    require_once('blog-item.php');
    require_once('dir-file-scanner.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $parsedown = new Parsedown();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DatenSindDaten</title>
    <link rel="stylesheet" href="fonts/inter.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="page-container">
        <div class="page-header">
            <div style="background-color: white;">
                <img src="img/dsd_logo.svg" alt="DatenSindDaten e. V. Logo" style="height: 100px; margin-bottom: 10px;"><br>

                <ul class="main-navigation" style="margin-top: 0em;">
                    <li>DatenSindDaten</li>
                    <li>Projekte</li>
                    <li>Blog</li>
                    <li>Kontakt</li>
                </ul>
            </div>
            <div class="image-container" style="background-image: url('img/dsd.png');">
            </div>
        </div>

        <div class="markdown-body">
            <?php
                $markdownContent = file_get_contents('willkommen.md');
                $html = $parsedown->text($markdownContent);
                echo $html;
            ?>
        </div>

        <?php
            $extract_callback = function($block, $file) {
                foreach (explode("\n", $block) as $line) {
                    if (preg_match('/^date\s*=\s*(\d{4}-\d{2}-\d{2})$/', trim($line), $dateMatch)) {
                        return [
                            'file' => $file,
                            'date' => $dateMatch[1]
                        ];
                    }
                }
                return null;
            };

            $sort_callback = function($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            };

            $result = scanMarkdownFilesInDir('./content-files/projects', $extract_callback, $sort_callback);
            /*
            echo "<h2>Sorted List of MD files:</h2>" . PHP_EOL;
            echo '<ol>';
            foreach ($result as $entry) {

                echo '<li>' . $entry. '</li>' . PHP_EOL;
            }
            echo '</ol>';
            */
            foreach ($result as $file_path) {
                renderBlogItem($parsedown, $file_path, $img_url = null, $link_url = null);
            }
        ?>

        <div class="page-footer">
            <p>
                Impressum<br>
                Kontakt
            </p>
        </div>

    </div>

</body>


</html>