<?php

function renderBlogItem($parsedown, $file_path, $img_url = null, $link_url = null) {
?>

<div class="blog-outer">
    <div class="markdown-body blog-container">
        <div>
            <?php
                $markdown_content = file_get_contents($file_path);

                // Remove front matter if present
                if (preg_match('/^---\s*(.*?)\s*---\s*/s', $markdown_content, $matches)) {
                    // Strip the front matter block from the content
                    $markdown_content = substr($markdown_content, strlen($matches[0]));
                }

                $html = $parsedown->text($markdown_content);
                echo $html;

                echo $img_url;
            ?>
            <div style="width: 100%; height:37px; text-align: left;">
                <svg id="svg-link-arrow-right" width="100px" height="37px" viewBox="0 0 100 37" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><path d="M70.075,14.666l-68.633,0c-0.796,0 -1.442,-0.646 -1.442,-1.442c-0,-0.796 0.646,-1.443 1.442,-1.443l68.633,0l-9.319,-9.319c-0.563,-0.563 -0.563,-1.477 -0,-2.04c0.563,-0.563 1.477,-0.563 2.04,0l11.782,11.782c0.274,0.275 0.422,0.641 0.422,1.02c0,0.379 -0.148,0.745 -0.422,1.02l-11.782,11.782c-0.563,0.563 -1.477,0.563 -2.04,-0c-0.563,-0.563 -0.563,-1.477 -0,-2.04l9.319,-9.32Z"/></svg>
            </div>
        </div>
        <?php
            if ($img_url != null) {
                echo "<div class=\"image-container\" style=\"background-image: url('$img_url')\">" . PHP_EOL;
                echo "</div>" . PHP_EOL;
            }
        ?>
    </div>
</div>

<?php
}

?>
