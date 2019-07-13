<?php
    include_once("config.php");
    $paper_id = $_GET["paper_id"];
    $q3 = mysql_query("select t.total_marks as total_marks, q.paper_name as paper_name, q.month_year as month_year, q.template_id as template_id 
    from questionpaper as q, templates as t where q.paper_id = '$paper_id' and q.template_id = t.template_id");
	if(mysql_num_rows($q3)>0)
	{
        $r3 = mysql_fetch_array($q3);
        $paper_name = $r3["paper_name"];
        $month_year = $r3["month_year"];
        $template_id = $r3["template_id"];
        $total_marks = $r3["total_marks"];

        ?>
            <table cellspacing = "1px" cellpadding = "5px" border = "0px" width = "500px" class = "mainTable" align = "center" style = "border:1px">
                <tr>
                    <td  width = "300px" colspan = "2" align = "center">
                        <b>IGNOU - <?php echo($paper_name);?> - <?php echo($month_year);?><br><br></b>
                    </td>
                    <td align = "center"  width = "200px">
                        <b>Total Marks: <?php echo($total_marks);?><br><br></b>
                    </td>
                </tr>
                 <?php
                    $q4 = mysql_query("select q.question as question, q.marks as marks from questionpaper_details as qd, 
                    questions as q where qd.question_id = q.question_id and qd.paper_id = '$paper_id'; ");
                    $i=0;
                    if(mysql_num_rows($q4)>0)
                    {
                        while($r4 = mysql_fetch_array($q4))
                        {
                            $i++;
                            $question= $r4["question"];
                            $marks= $r4["marks"];

                            ?>
                                <tr>
                                    <td align = "left" width = "50px">
                                        <?php echo($i);?>
                                    </td>
                                    <td align = "left" width = "600px">
                                        <?php echo(nl2br($question));?>
                                    </td>
                                    <td align = "left" width = "100px">
                                        (<?php echo($marks);?> Marks)
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan = "3">
                                        &nbsp;
                                    </td>
                                <tr>
                            <?php
                        }
                    }
				?>
			</table>
		<?php
	}
?>