<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src = "main.js"></script>
		<title>Edit Paper</title>
	</head>
	<body>
		<div class = "mainDiv" align = "center">
			<?php
				include_once("header.php");
				$paper_id1 = $_GET["paper_id"];
				$q3 = mysql_query("select p.paper_id as paper_id, p.paper_name as paper_name, p.month_year as month_year, p.status as status,
                t.template_name as template_name, t.template_id as template_id from questionpaper as p, templates as t where p.paper_id = '$paper_id1' and 
                p.template_id = t.template_id");
				if(mysql_num_rows($q3)>0)
				{
					$r3 = mysql_fetch_array($q3);
                    $paper_name1= $r3["paper_name"];
                    $template_name1= $r3["template_name"];
                    $template_id1= $r3["template_id"];
                    $month_year1= explode("/",$r3["month_year"]);
                    $month1 = $month_year1[0];
                    $year1 = $month_year1[1];
                    $status1= $r3["status"];
            }
			?>
			<form action = "editPaper2.php" method = "POST" onSubmit = "">
				<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
					<tr>
						<td width = "50%">
							Paper Name:
						</td>
						<td>
							<input type = "text" value = "<?php echo($paper_name1);?>"  name = "paper_name" id = "paper_name">
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Template Name:
						</td>
						<td>
							<select name = "template_id" id = "template_id">
								<option value = "-1">Select Template</option>
								<?php
									$q3 = mysql_query("select * from templates where status = '1' order by template_name asc;");
									if(mysql_num_rows($q3)>0)
									{
										while($r3 = mysql_fetch_array($q3))
										{
											$template_id = $r3["template_id"];
                                            $template_name = $r3["template_name"];
                                            if($template_id == $template_id1)
                                            {
    											?>
	    											<option selected value = "<?php echo($template_id);?>"><?php echo($template_name);?></option>
		    									<?php
                                            }
                                            else 
                                            {
    											?>
	    											<option value = "<?php echo($template_id);?>"><?php echo($template_name);?></option>
		    									<?php                                                
                                            }
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Month Year:
						</td>
						<td>
                            <select name = "month" id = "month">
                                <?php
                                    for($i=1;$i<=12;$i++)
                                    {
                                        if ($month1 == $i)
                                        {
                                            ?><option selected value = "<?php echo($i);?>"><?php echo($i);?></option><?php
                                        }
                                        else
                                        {
                                            ?><option value = "<?php echo($i);?>"><?php echo($i);?></option><?php
                                        }
                                    }
                                ?>
                            </select>
                            <select name = "year" id = "year">
                                <?php
                                    for($i=2019;$i<=2030;$i++)
                                    {
                                        if ($year1 == $i)
                                        {
                                            ?><option selected value = "<?php echo($i);?>"><?php echo($i);?></option><?php
                                        }
                                        else
                                        {
                                            ?><option value = "<?php echo($i);?>"><?php echo($i);?></option><?php
                                        }
                                    }
                                ?>
                            </select>							
						</td>
					</tr>
					<tr>
						<td width = "50%">
							Status:
						</td>
						<td>
                        <select name = "status" id = "status">
                            <?php 
                                if($status1=="1")
                                {
                                    ?>
                                        <option selected value = "1">Active</option>
                                        <option value = "0">InActive</option>
                                    <?php
                                }
                                else 
                                {
                                    ?>
                                        <option value = "1">Active</option>
                                        <option selected value = "0">InActive</option>
                                    <?php
                                }
                            ?>
                        </select>
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center">
							<input type = "hidden" value = "<?php echo ($paper_id1);?>"  name = "paper_id" id = "paper_id">
							<input type = "submit" value = "Update and Generate">
						</td>
					</tr>
				</table>
			</form>
			<div>
				<?php
					include_once("listPapers.php");
				?>
			</div>
		</div>
	</body>
</html>