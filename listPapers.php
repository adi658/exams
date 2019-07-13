<?php
	include_once("config.php");
    $q3 = mysql_query("select p.paper_id as paper_id, p.paper_name as paper_name, p.month_year as month_year, p.status as status,
                        t.template_name as template_name from questionpaper as p, templates as t where 
                        p.template_id = t.template_id");
	if(mysql_num_rows($q3)>0)
	{
		?>
			<table cellspacing = "1px" cellpadding = "5px" border = "1px" width = "100%" class = "mainTable" align = "center">
				<tr style = "background-color:#CBC3E8">
					<td align = "center" colspan = "6">
						<b style = 'color:#C43B05;'>Question Paper List</b>
					</td>
				</tr>
				<tr style = "background-color:#CBC3E8">
					<td align = "center" width "20px">
						Sno.
					</td>
					<td align = "center" width "200px">
						Paper Name
					</td>
					<td align = "center" width "200px">
						Template Name
					</td>
					<td align = "center" width "200px">
						Month Year
					</td>
					<td align = "center" width "200px">
						Status
					</td>
					<td align = "center" width "100px">
						Action
					</td>
				</tr>
				<?php
					$i=0;
					while($r3 = mysql_fetch_array($q3))
					{
						$i++;
						$paper_id= $r3["paper_id"];
						$paper_name= $r3["paper_name"];
						$template_name= $r3["template_name"];
						$month_year= $r3["month_year"];
                        $status= $r3["status"];
                        if($status == "1") { $status = "<b style = 'color:green;font-weight:bold'>Active</b>"; } else if($status == "0") { $status = "<b style = 'color:red;font-weight:bold'>InActive</b>"; } else if($status == "2") { $status = "<b style = 'color:green;font-weight:bold'>Generated</b>"; } 

						?>
							<tr>
								<td align = "center">
									<?php echo($i);?>
								</td>
								<td align = "center">
                                    <?php echo($paper_name);?>
								</td>
								<td>
                                    <?php echo($template_name);?>
								</td>
								<td>
                                    <?php echo($month_year);?>
								</td>
								<td>
                                    <?php echo($status);?>
								</td>
								<td align = "center">
                                    <a href = "viewPaper.php?paper_id=<?php echo($paper_id);?>">View</a> |
                                    <a href = "editPaper.php?paper_id=<?php echo($paper_id);?>">Edit/Generate Paper</a> |
									<a href = "editPaper2.php?paper_id=<?php echo($paper_id);?>&type=del">Delete</a>
								</td>
							</tr>
						<?php
					}
				?>
			</table>
		<?php
	}
?>