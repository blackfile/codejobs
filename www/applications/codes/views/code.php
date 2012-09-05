<?php
    if(!defined("_access") {
        die("Error: You don't have permission to access here...");
    }
    
    $this->CSS("code", "codes", TRUE);
?>
<div class="codes">
	<h2>
		<?php echo getLanguage($code["Language"], TRUE); ?> <a href="<?php echo path("codes/". $code["ID_Code"] . "/" . $code["Slug"]); ?>" title="<?php echo $code["Title"]; ?>"><?php echo $code["Title"]; ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo __("Published") ." ". howLong($code["Start_Date"]) ." ". __("by") .' <a title="'. $code["Author"] .'" href="'. path("users/". $code["Author"]) .'">'. $code["Author"] .'</a> '; 
			 
			if($code["Languages"] !== "") {
				echo __("in") ." ". exploding(implode(", ", array_map("strtolower", explode(", ", $code["Languages"]))), "codes/language/");
			}
		?>			
		<br />

		<?php 
			echo '<span class="bold">'. __("Likes") .":</span> ". (int) $code["Likes"]; 
			echo ' <span class="bold">'. __("Dislikes") .":</span> ". (int) $code["Dislikes"];
			echo ' <span class="bold">'. __("Views") .":</span> ". (int) $code["Views"];
		?>
	</span>

    <div class="addthis_toolbox addthis_default_style ">
        <a class="addthis_button_tweet" tw:via="codejobs" addthis:title="<?php echo $code["Title"]; ?>" tw:url="<?php echo path("codes/". $code["ID_Code"] ."/". $code["Slug"]); ?>"></a>
    </div>	
    <?php
        foreach ($code["Files"] as $file) {
        ?>
            <p>
                <div class="title-file">
                    <?php
                        echo tagHTML("div", array("class" => "filename"), $file["Name"]);
                        
                        echo tagHTML("a", array(
                            "name"  => slug($file["Name"]),
                            "class" => "permalink",
                            "title" => __("Permalink to this file"),
                            "href"  => "#" . slug($file["Name"])
                        ), "&para;&nbsp;");
                    ?>
                </div>

                <textarea name="code" data-syntax="<?php echo $file["ID_Syntax"];?>"><?php echo stripslashes($file["Code"]); ?></textarea>
            </p>
        <?php
        }
		
        if(SESSION("ZanUser") {
	    ?>
			<p class="small italic">
				<?php  echo like($code["ID_Code"], "codes", $code["Likes"]) ." ". dislike($code["ID_Code"], "codes", $code["Dislikes"]) ." ". report($code["ID_Code"], "codes"); ?>
			</p>
	    <?php
		}
	?>

    <p>
        <a name="comments">
            <div class="fb-comments" data-href="<?php echo path("codes/". $code["ID_Code"] ."/". $code["Slug"]); ?>" data-num-posts="2" data-width="750"></div>
        </a>
    </p>
	
	<p>
		<a href="<?php echo path("codes"); ?>">&lt;&lt; <?php echo __("Go back"); ?></a>
	</p>
</div>

<script type="text/javascript">
    var syntax = [];
    
    <?php
        $data = getSyntax();
        
        foreach($data as $language) {
        ?>
            syntax[<?php echo $language["ID_Syntax"]; ?>] = <?php echo json($language); ?>;
        <?php
        }
    ?>
</script>

<?php
    echo $this->js("codes.js", "codes", TRUE);
?>