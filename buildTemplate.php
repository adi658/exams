<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Build Template</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
			?>
			<form action = "buildTemplate2.php" method = "POST" onSubmit = "return val_addQuestion();">
                <table cellspacing = "0px" cellpadding = "0px" border = "0px" width = "100%" class = "mainTable" align = "center">
                    <tr>
                        <td width = "300px" style = "padding:5px;font-weight:bold;">
                            Template Name:
                        </td>
                        <td width = "300px" style = "padding:5px;font-weight:bold;" colspan = "2">
                            <select name = "template_id" id = "template_id" onChange = "getTemplateDetails(1)">
                                <option value = "-1">Select Template</option>
                                <?php
                                    $q3 = mysql_query("select * from templates order by template_name asc;");
                                    if(mysql_num_rows($q3)>0)
                                    {
                                        while($r3 = mysql_fetch_array($q3))
                                        {
                                            $template_id = $r3["template_id"];
                                            $template_name = $r3["template_name"];
                                            ?>
                                                <option value = "<?php echo($template_id);?>"><?php echo($template_name);?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>							
                        </td>
                    </tr>
                    <tr>
                        <td width = "300px" style = "padding:5px;font-weight:bold;">
                            Subject Name
                        </td>
                        <td width = "300px" style = "padding:5px;font-weight:bold;">
                            Subtopic Name
                        </td>
                        <td width = "300px" style = "padding:5px;font-weight:bold;">
                            Marks
                        </td>
                        <td width = "300px" style = "padding:5px;font-weight:bold;">
                            Count
                        </td>
                    </tr>
                    <tr>
                        <td id = "subject_td_1" width = "300px">
                            <input type = "hidden" value = "" name = "subject_id_1" id = "subject_id_1" readonly> 
                            <input type = "text" value = "" name = "subject_name_1" id = "subject_name_1" readonly> 
                        </td>
                        <td id = "subtopic_td_1" width = "300px">
                            <select name = "subtopic_id_1" id = "subtopic_id_1">
                                <option value = "-1">Select Subtopic</option>
                            </select>
                        </td>
                        <td>
                            <select name = "marks_1" id = "marks_1"  width = "300px">
                                <option value = "-1">Select Marks</option>
                                <option value = "5">5</option>
                                <option value = "10">10</option>
                                <option value = "10">15</option>
                            </select>
                        </td>
                        <td width = "300px">
                            <select name = "count_1" id = "count_1">
                                <?php
                                    for($i=1;$i<=10;$i++)
                                    {
                                        ?>
                                                <option value = "<?php echo($i);?>"><?php echo($i);?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan = "4" id = "table_2"></td>
                    </tr>
                    <tr>
                        <td colspan = "4" align = "center">
                            <input type = "hidden" value = "1" name = "current_records" id = "current_records">
                            <input type = "button" value = "Add Row" onClick = "addTemplateRow()">
                        </td>
                    </tr>
                </table>			
                <div>
                    <input type = "submit" value = "Submit">
                </div>
            </form>
            <div id = 'ajax_div' style = "display:none;">&nbsp;</div><br>
			<div id = "listTemplates_div">
                &nbsp;
			</div>
		</div>
	</body>
</html>