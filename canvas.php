<!--coment to see if commits work-->

<?php
require 'php/connect.inc.php';

$canvas_id = 0;
$customer_persona_selected = false;
?>

<?php	
	if (!empty($_POST['customer_segment-submit'])) {
	   $value = $_POST['name'];
	   
	   $sql = "INSERT INTO customer_segments (canvas_id, name) VALUES ('$canvas_id', '$value')";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
	
	if (!empty($_POST['customer_persona-view'])) {
		$customer_persona_selected = true;
		$customer_persona_id = $_POST['customer_persona-view'];
	}
	
	if (!empty($_POST['customer_segment-delete'])) {
		$customer_segment_id = $_POST['customer_segment-delete'];
		
		$sql = "DELETE FROM customer_segments WHERE id = '$customer_segment_id'";

		if (!mysql_query($sql)) {
			die('ERROR: ' . mysql_error());
		}
	}
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>The Business Model Canvas</title>
	<meta name="description" content="The Business Model Canvas">
	<meta name="author" content="DISCE - Jake Byrne">
	<link rel="stylesheet" href="css/style.css">
	<!--styly boxes-->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
	<script src="js/colResizable-1.3.min.js"></script>
	<script src="js/jquery.mjs.nestedSortable.js"></script>
	<!--<script src="js/canvas_buttons.js"></script>-->
	<!-- stops side nav buttons from working in php -->
	<!--<script src="//code.jquery.com/jquery-1.9.1.js"></script>-->
	<!--<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
	
</head>
<body>


	<div id="canvas">

	
		<div id="Customer_Segments" class="canvas_section">
			<img class="section_background" src="img/customer-section.png">
				<div class="canvas_content">
					<!--<button type="button" onclick="alert('Add more')">Add More</button>-->
					<button id="create-segment">Create Segment</button>
				<ol class="sortable">
<!--
					<ol class="hidden">

					<li id="list_1"><div><span class="disclose"><span></span></span>Industries</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Manufacturing</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Services</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>R & D</div>
					</ol>
					<li id="list_1"><div><span class="disclose"><span></span></span>SMEs</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>C-level Execs</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>VPs</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Directors</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Division Managers</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Individual Employees</div>
					</ol>
					</ol>

					<li id="list_1"><div><span class="disclose"><span></span></span>First-Time Entrepreneurs (single user)</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Early-Stage Startups (Teams)</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>WearIT <img class="selected_element" src="img/arrow.png" height="20"></div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Writing for Tiny</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Campus Company Spin-Outs</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>High-Potential Start-Ups</div>
						<button id="create-customer">Create Customer</button>
					</ol>
					<li id="list_1"><div><span class="disclose"><span></span></span>Private Investors </div>
-->			
										<?php
						/* retrieve list of customer segments from customer_segments table and display results in html */
						$query = "SELECT * FROM customer_segments WHERE canvas_id = '$canvas_id'";
						if($query_run = mysql_query($query)){
							
							while ($row = mysql_fetch_array($query_run)) {
								$segment_id = $row['id'];
								$segment_name = $row['name'];
								echo '<li id="list_1"><div><span class="disclose"><span></span></span>' . $segment_name . '</div>';
								echo '<ol>';
								$query2 = "SELECT * FROM customer_persona WHERE customer_segments_id = '$segment_id'";
								if($query_run2 = mysql_query($query2)){
									while ($row2 = mysql_fetch_array($query_run2)) {
										$customer_name = $row2['name'];
										$customer_id = $row2['id'];
										echo '<li id="list_2"><div><span class="disclose"><span></span></span>' . $customer_name . '</div>';
										echo '<form action="canvas.php" method="post"> <button name="customer_persona-view" type="submit" value="' . $customer_id . '">View</button> </form>';
									}
								}
								echo '<form action="canvas.php" method="post"> <button name="customer_segment-delete" type="submit" value="' . $segment_id . '">Delete Segment</button> </form>';
								echo '<button id="create-customer">Create Customer</button>';
								echo '</ol>';
							}

						}
					?>
										
					<ol class="hidden">
						<li id="list_1"><div><span class="disclose"><span></span></span>Consultants</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Management</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Strategy </div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Human Resources</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>IT</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Marketing</div>
					</ol>
					</ol>	

				</ol>
			</div>
		</div>
		
		<?php
			if ($customer_persona_selected) {
				/* retrieve contents of customer_persona table and display results in html */
				$query = "SELECT * FROM customer_persona WHERE id = '$customer_persona_id'";
				if($query_run = mysql_query($query)){
					$query_num_rows = mysql_num_rows($query_run);
					if($query_num_rows == 0){
						die('Table SELECT failed.');
					}
					else{
						$name = mysql_result($query_run, 0, 'persona_name');
						$location = mysql_result($query_run, 0, 'location');
						$age = mysql_result($query_run, 0, 'age');
						$gender = mysql_result($query_run, 0, 'gender');
						$family_size = mysql_result($query_run, 0, 'family_size');
						$income = mysql_result($query_run, 0, 'income');
						$occupation = mysql_result($query_run, 0, 'occupation');
						$education = mysql_result($query_run, 0, 'education');
					}
				}
			} else {
				$name = "";
				$location = "";
				$age = "";
				$gender = "";
				$family_size = "";
				$income = "";
				$occupation = "";
				$education = "";
			}
		?>

		<div id="Customer_personas" class="Customer_Segments_Tool canvas_depth">
			<br>
			<h1>Start-Up Personas</h1>
			<div class="canvas_content">
				<table border="1">
					<tr>
						<td>name</td>
						<td><?php echo $name; ?></td>
						
					</tr>
					<tr>
						<td>photo</td>
						<td><img src="img/start-up-sam.jpg"></td>
					</tr>
					<tr>
						<td>Location</td>
						<td><?php echo $location; ?></td>
					</tr>
					<tr>
						<td>age</td>
						<td><?php echo $age; ?></td>
					</tr>
					<tr>
						<td>gender</td>
						<td><?php echo $gender; ?></td>
					</tr>
					<tr>
						<td>family size</td>
						<td><?php echo $family_size; ?></td>
					</tr>
					<tr>
						<td>income</td>
						<td><?php echo $income; ?></td>
					</tr>
					<tr>
						<td>occupation</td>
						<td><?php echo $occupation; ?></td>
					</tr>
					<tr>
						<td>education</td>
						<td><?php echo $education; ?></td>
					</tr>
				</table>

			</div>
		</div>

		<div id="Value_Proposition" class="canvas_section ">
			<img class="section_background" src="img/value-section.png">

			<div class="canvas_content">
			<h1 class="Value_product_heading">Product Type</h1>		
			<select>
			  <option value="volvo">Web Platform</option>
			  <option value="saab">Software as a Services</option>
			  <option value="opel">Moble Application</option>
			  <option value="audi">Hardware device</option>
			  <option value="audi">Enterprise Service</option>
			  <option value="audi">Consultancy Service</option>
			  <option value="audi">Hobby Tool</option>
			</select>

			<br><hr><h1 class="Value_product_heading">Product Name</h1>
			
			<input type="text" size="22"  name="FirstName" value="DISCE Business Model Hub"><br>	
			
			
			<hr><br><h1 class="Value_product_heading">Elevator Pitch</h1> <span class="PitchValue"></span>
	
			<span class="PitchValue">DISCE Business Model Hub</span><input class="PitchValueSelect" type="text" name="FirstName" size="30" value="DISCE Business Model Hub"> is a 
			<span class="PitchValue">Web Platform</span>
			<select class="PitchValueSelect">
			  <option value="Web Platform">Web startup</option>
			  <option value="Software as a Services">Software as a Services</option>
			  <option value="Mobile Application">Mobile Application</option>
			  <option value="Hardware device">Hardware device</option>
			  <option value="Enterprise Service">Enterprise Service</option>
			  <option value="Consultancy Service">Consultancy Service</option>
			  <option value="Hobby Tool">Hobby Tool</option>
			</select> offering a 
			<span class="PitchValue">business modelling platform</span>
			<select class="PitchValueSelect">
			  <option value="business development">business modelling platform</option>
			  <option value="open innovation">open innovation</option>
			  <option value="developing disruptive business models">developing disruptive business models</option>
			</select> targeted at 
			<span class="PitchValue">the start-up community</span>
			<select class="PitchValueSelect">
			  <option value="Start-ups">the start-up community</option>
			  <option value="Entrepreneurs">Entrepreneurs</option>
			  <option value="SMEs">SMEs</option>
			</select> to
			<span class="PitchValue">help defining their MVP</span>
			<select class="PitchValueSelect">
			  <option value="help defining their MVP">streamline communication between founders, mentors & investors</option>
			  <option value="help defining their MVP">help defining their MVP</option>
			  <option value="help defining their route to market">help defining their route to market</option>
			  <option value="help scafollding ideas">help scafollding ideas</option>
			</select>. Unlike 
			<span class="PitchValue">Strategyzer</span>
			<select class="PitchValueSelect">
			  <option value="Strategyzer">Strategyzer</option>
			  <option value="Lean Launch Lab">Lean Launch Lab</option>
			  <option value="Gust">Gust</option>
			  <option value="Angel-List">Angel-List</option>
			</select> we provide a 
			<span class="PitchValue">Localised</span>
			<select class="PitchValueSelect">
			  <option value="Localised">Localised</option>
			  <option value="targeted">targeted</option>
			  <option value="streamlined">streamlined</option>
			</select> product/service for 
			<span class="PitchValue">business development</span>
			<select class="PitchValueSelect">
			  <option value="business development">business development</option>
			  <option value="open innovation">open innovation</option>
			  <option value="developing disruptive business models">developing disruptive business models</option>
			</select>.
			<br>

			</div>
		</div>
		
		
		<div id="Value_Pains" class="Value_Proposition_Tool canvas_depth">
			<br>
			<h1>Start-Up Pains</h1>
			<div class="canvas_content">
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
					<table border="1" style="width: 100%;">
						<tr>
							<td>Testing business models </td>
						</tr>
						<tr>
							<td>Validating business models </td>
						</tr>
						<tr>
							<td>Communicating business strategy </td>
						</tr>
						<tr>
							<td>Finding talent </td>
						</tr>
						<tr>
							<td>Finding mentors </td>
						</tr>
						<tr>
							<td>Access to seed capital </td>
						</tr>
						<tr>
							<td>Pivoting to customer needs  </td>
						</tr>
				</table>
			</div>
		</div>		
		
		<div id="Value_Gains" class="Value_Proposition_Tool canvas_depth">
			<br>
			<h1>Start-Up Gains</h1>

			<div class="canvas_content">
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
					<table border="1" style="width: 100%;">
						<tr>
							<td>Collaborative business models </td>
						</tr>
						<tr>
							<td>Peer-to-Peer supports </td>
						</tr>
						<tr>
							<td>Access to pool of mentors </td>
						</tr>
						<tr>
							<td>Presentation-Business Plan Templates</td>
						</tr>
						<tr>
							<td>Talent Search</td>
						</tr>
				</table>
			</div>
		</div>	
		
		<div id="Value_Features" class="Value_Proposition_Tool canvas_depth">
			<br>
			<h1>Start-Up Features</h1>
			<div class="canvas_content">
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
					<table border="1" style="width: 100%;">
						<tr> 
							<td>Open Innovation Web Platform</td>
						</tr>
						<tr>
							<td>Disruptive business model generation software – export to business plan/slide deck</td>
						</tr>
						<tr>
							<td>Open Innovation marketplace – access to local/regional resources</td>
						</tr>
						<tr>
							<td>Business Model Hub™</td>
						</tr>
						<tr>
							<td>Visualised customer archetypes</td>
						</tr>
						<tr>
							<td>Lifetime cost vs. acquisition value tools</td>
						</tr>
						<tr>
							<td>Channel economics tools</td>
						</tr>
						<tr>
							<td>Unit economics tools</td>
						</tr>
						<tr>
							<td>metaSWOT Analysis of whole business model</td>
						</tr>
						<tr>
							<td>Alternative business model strategy suggestions</td>
						</tr>
						<tr>
							<td>Innovation Marketplace™</td>
						</tr>
						<tr>
							<td>Access to talent through IA network</td>
						</tr>
						<tr>
							<td>Access to mentors/advisors in Academia/Government for market insight</td>
						</tr>
						<tr>
							<td>Access to business angels/VCs/government grants</td>
						</tr>
						<tr>
							<td>Access to enterprise partners</td>
						</tr>
						<tr>
							<td>Access to consultants in Industry</td>
						</tr>
						<tr>
							<td>Access to IP portfolios in Universities</td>
						</tr>
				</table>
			</div>
		</div>
		<div id="Value_Comp" class="Value_Proposition_Tool canvas_depth">
			<br>
			<h1>Competition</h1>
			<div class="canvas_content">
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
					<table border="1" style="width: 100%;">
						<tr> 
							<td>Strategyzer (product)</td>
						</tr>
						<tr> 
							<td>Launch Pad Lab (product)</td>
						</tr>
						<tr> 
							<td>Gust (service)</td>
						</tr>
						<tr> 
							<td>Angel-list (service)</td>
						</tr>
						<tr> 
							<td>Seedcamp (service)</td>
						</tr>

				</table>

				<br>
				<hr>
				<h1 class="CanvasSub">Your Unique Advantage/Identifier</h1>
				<hr>
				<table border="1" style="width: 100%;">
						<tr> 
							<td>Freemium</td>
						</tr>
						<tr> 
							<td>Greater Depth</td>
						</tr>
						<tr> 
							<td>Open Innovation</td>
						</tr>
						<tr> 
							<td>Multi-sided</td>
						</tr>

				</table>
				
			</div>
		</div>
		
		<div id="Value_flow" class="Value_Proposition_Tool">		
			<img class="workflow_arrow workflow_arrow1" src="img/arrow.png" height="20">
			<img class="workflow_arrow workflow_arrow2" src="img/arrow.png" height="20">
			<img class="workflow_arrow workflow_arrow3" src="img/arrow.png" height="20">
			<img class="workflow_arrow workflow_arrow4" src="img/arrow.png" height="20">
		</div>
		
		<div id="Customer_Relationships" class="Customer_Relationships_Tool canvas_section">
			<img class="section_background" src="img/relationships-section.png">
			<div class="canvas_content">
			<!--relationship button-->
					<button id="create-relationship">Create relatoinship</button>
				<ol class="sortable relationship_contents">
					<li id="list_1" class="list_get"><div><span class="disclose"><span></span></span>Get</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Paid</div>
						<ol>
							<li id="list_2"><div><span class="disclose"><span></span></span>adverts <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
							<li id="list_2"><div><span class="disclose"><span></span></span>webinars <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
							<li id="list_2"><div><span class="disclose"><span></span></span>SEO <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
							<li id="list_2"><div><span class="disclose"><span></span></span>Sales Team <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
						</ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Earned</div>
						<ol>
							<li id="list_2"><div><span class="disclose"><span></span></span>word of mouth</div>
							<li id="list_2"><div><span class="disclose"><span></span></span>blogging</div>
							<li id="list_2"><div><span class="disclose"><span></span></span>social media</div>
						</ol>
					</ol>
					<li id="list_1" class="list_keep"><div><span class="disclose"><span></span></span>Keep</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Co-Creation</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Communities</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Client Relationship Managers</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Self-Service</div>
					</ol>
					<li id="list_1" class="list_grow"><div><span class="disclose"><span></span></span>Grow</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>New/Updated Features  <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Tiered Service Packages <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Larger Network available <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						<li id="list_2"><div><span class="disclose"><span></span></span>New Partners <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						<li id="list_2"><div><span class="disclose"><span></span></span>International Presence <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
					</ol>
				</ol>
			</div>
		</div>
		
				
		<div id="Relationship_Get" class="Customer_Relationships_Tool canvas_depth">
			<br>
			<h1>Get</h1>
			<div class="canvas_content">
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
				<ol class="sortable relationship_contents ui-sortable">
						<li id="list_2"><div><span class="disclose"><span></span></span>Paid</div>
						<ol>
							<li id="list_2"><div><span class="disclose"><span></span></span>adverts <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
							</li><li id="list_2"><div><span class="disclose"><span></span></span>webinars <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
							</li><li id="list_2"><div><span class="disclose"><span></span></span>SEO <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
							</li><li id="list_2"><div><span class="disclose"><span></span></span>Sales Team <img class="cost_icon" src="img/euro_red.png" height="18" title="cost per customer?"></div>
						</li></ol>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>Earned</div>
						<ol>
							<li id="list_2"><div><span class="disclose"><span></span></span>word of mouth</div>
							</li><li id="list_2"><div><span class="disclose"><span></span></span>blogging</div>
							</li><li id="list_2"><div><span class="disclose"><span></span></span>social media</div>
						</li></ol>
						</li>
				</ol>
			</div>
		</div>	
		
		<div id="Relationship_Keep" class="Customer_Relationships_Tool canvas_depth">
			<br>
			<h1>Keep</h1>
			
			<div class="canvas_content">
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
				<ol class="sortable relationship_contents ui-sortable">
						<li id="list_2"><div><span class="disclose"><span></span></span>Co-Creation</div>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>Communities</div>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>personal assistance</div>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>Self-Service</div>
						</li>
				</ol>
			</div>
		</div>	
		
		<div id="Relationship_Grow" class="Customer_Relationships_Tool canvas_depth">
			<br>
			<h1>Grow</h1>
			<div class="canvas_content">
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
			<ol class="sortable relationship_contents ui-sortable">

				
						<li id="list_2"><div><span class="disclose"><span></span></span>New/Updated Features  <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>Tiered Service Packages <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>Larger Network available <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>New Partners <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						</li><li id="list_2"><div><span class="disclose"><span></span></span>Company life-cycle features <img class="cost_icon" src="img/euro_green.png" height="18" title="increased value per customer?"></div>
						</li>
				</ol>
			</div>
		</div>
		
		
		<div id="Relationship_cost" class="Customer_Relationships_Tool canvas_depth">
			<br>
			<h1>Lifetime value <br> vs. <br>Acquisition cost</h1>
			<div class="canvas_content2">
				<br>
				<div style="text-align: center !important;"><strong>Acquisition Cost:</strong></div>
				<br>
				<span title="e.g. cost per click">get costs: <input type="text" size="5" id="CAC_cost" name="FirstName" value="0" class="CAC"></span>
				<br> total reachable audience: <input type="text" size="5" id="CAC_audience" name="FirstName" value="0" class="CAC">
				<br> Percentage converted to sales:  <input type="text" size="5" id="CAC_sales" name="FirstName" value="0" class="CAC">
				<br> 
				<br> Customer Acquisition Cost (CAC):  <input type="text" size="5" id="CustomerAcquisitionCost" name="FirstName" value="0" disabled>
				<br>
				<br>
				<div style="text-align: center !important;"><strong>Lifetime Value:</strong></div>
				<br> average customer payment/year: <input type="text" size="5" id="LV_payment" name="FirstName" value="0" class="LV">
				<br> average lifetime (in years):  <input type="text" size="5" id="LV_lifetime" name="FirstName" value="0" class="LV">
				<br> 
				<br> Gross Lifetime Value (LV):  <input type="text" size="5" id="LifetimeValue" name="FirstName" value="0" disabled>
				<br>
				<br>
				<div style="text-align: center !important;"><strong>Net Lifetime Value:</strong><br>
				<input type="text" size="5" id="Lifetime_profit"  name="FirstName" value="180" disabled>
				<br>
				LV - CAC 
				</div>
				
			</div>
		</div>		
		
		<div id="Channels" class="canvas_section">
			<img class="section_background" src="img/channels-section.png">
			<div class="canvas_content">
			<!-- channels button-->
				<button id="create-channel">Create channel</button>
				<btn1 type="button" onclick="alert('Add more')">Add More</btn1>
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Digital</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>E-Commerce</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Sales Team</div>
					</ol>
					<li id="list_1"><div><span class="disclose"><span></span></span>Physical</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Incubation Hubs</div>
					</ol>

				</ol>
			</div>
		</div>
		
		

		<div id="Channel_economics" class="Channels_Tool canvas_depth">
			<br>
			<h1>Channel Economics</h1>
			<div class="canvas_content">
				<strong>Direct Sales:</strong>
				<span title="e.g. price the customer will pay">List Price: <input type="text" size="5" id="Chan_Eco_list_price" value="100"></span>
				<table id="Channel_Eco_Direct" width="100%" cellspacing="0" cellpadding="0" border="0" class="CRZ">
					<tbody>
						<tr>
							<td id="Chan_RD" style="width: 122px; background-color:#00AEEF;"  class="Channel_Eco_OEM">R&D, Selling, Gen&Admin<br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Cost" style="width: 189px; background-color: #ed146f;" class="Channel_Eco_OEM">Cost of Goods <br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Profit" style="width: 107px; background-color: #cfd729;"  class="Channel_Eco_OEM">Profit<br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Mup" style="width: 83px;"  class="Channel_Eco_OEM">Mark-up<br> (<span class="chan_eco_value"></span>)</td>
						</tr>
					</tbody>
				</table>
				<br><br>
				<br><br>
								<strong>Indirect Sales:</strong>
				<span title="e.g. price the customer will pay">List Price: <input type="text" size="5" id="Chan_Eco_list_price" value="100"></span>
				<table id="Channel_Eco_Indirect" width="100%" cellspacing="0" cellpadding="0" border="0" class="CRZ">
					<tbody>
						<tr>
							<td id="Chan_RD" style="width: 122px; background-color:#00AEEF;"  class="Channel_Eco_OEM">R&D, Sales, Gen&Admin<br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Cost" style="width: 150px; background-color: #ed146f;" class="Channel_Eco_OEM">Cost of Goods <br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Cost" style="width: 100px; background-color: #00AEEF;" class="Channel_Eco_OEM">Reseller <br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Profit" style="width: 52px; background-color: #cfd729;"  class="Channel_Eco_OEM">Profit<br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Mup" style="width: 83px;"  class="Channel_Eco_OEM">Mark-up<br> (<span class="chan_eco_value"></span>)</td>
						</tr>
					</tbody>
				</table>
				<br><br>
				<br><br>
								<strong>OEM Sales:</strong>
				<span title="e.g. price the customer will pay">List Price: <input type="text" size="5" id="Chan_Eco_list_price" value="100"></span>
				<table id="Channel_Eco_OEM" width="100%" cellspacing="0" cellpadding="0" border="0" class="CRZ">
					<tbody>
						<tr>
							<td id="Chan_RD" style="width: 122px; background-color:#00AEEF;"  class="Channel_Eco_OEM">R&D, Sales, Gen&Admin<br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Cost" style="width: 150px; background-color: #ed146f;" class="Channel_Eco_OEM">Cost of Goods <br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Cost" style="width: 100px; background-color: #00AEEF;" class="Channel_Eco_OEM">Distributor <br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Cost" style="width: 100px; background-color: #ed146f;" class="Channel_Eco_OEM">Reseller <br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Profit" style="width: 52px; background-color: #cfd729;"  class="Channel_Eco_OEM">Profit<br> (<span class="chan_eco_value"></span>)</td>
							<td id="Chan_Mup" style="width: 83px;"  class="Channel_Eco_OEM">Mark-up<br> (<span class="chan_eco_value"></span>)</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		

		<div id="Key_Partners" class="canvas_section">
			<img class="section_background" src="img/partners-section.png">
			<div class="canvas_content">
					<!--partners button-->
					<button id="create-partner">Create partner</button>

				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Joint Business Development (Time to Market)</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Trinity College Dublin</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>DBIC<img class="selected_element" src="img/arrow.png" height="20"></div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Business Innovation Centres</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>HBAN</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Bloom Equity</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Irrus Investments</div>
					</ol>			
					<li id="list_1"><div><span class="disclose"><span></span></span>Joint Business Development (Broader Product Offering)</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Innovation Academy</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>UCD/DCU/UCC/NUIG</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Enterprise Ireland</div>
					</ol>			
					<li id="list_1"><div><span class="disclose"><span></span></span>Strategic Alliance (Unique know-how)</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Incubation Hubs: NDRC/Wayra/NovaUCD</div>
					</ol>


				</ol>
			</div>
		</div>
		
		
		<div id="Key_Partners_Details" class="Key_Partners_Tool canvas_depth">
			<br>
			<h1>DBIC</h1>

			<div class="canvas_content">
				<img class="" src="http://dublin2013.drupaldays.org/sites/default/files/dbic-logo.png"><br>
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span><strong>Relationship</strong></div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Strategic alliance</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>traffic partners</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Financial support</div>
					</ol>
					<li id="list_1"><div><span class="disclose"><span></span></span><strong>Resource</strong></div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Time to market</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>access to new markets</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>capital</div>
					</ol>
				</ol>
			</div>
		</div>

		<div id="Revenue_Streams" class="canvas_section">
			<img class="section_background" src="img/revenue-section.png">
			<div class="canvas_content">
									<!--revenue stream button-->
					<button id="create-revenue-stream">Create revenue stream</button>

				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Market Type</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Segmented market</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Emerging Market</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Mass Market</div>
					</ol>
					<li id="list_1"><div><span class="disclose"><span></span></span>Value Driven Strategy</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Freemium</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Subscriptions</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Monthly/Yearly</div>
						<ol>
							<li id="list_3"><div><span class="disclose"><span></span></span>Start-Ups €150/year</div>
							<li id="list_3"><div><span class="disclose"><span></span></span>SMEs (under 50) €300+/year</div>
						</ol>
					</ol>
				</ol>
			</div>
		</div>
		
		<div id="Revenue_Strategy" class="Revenue_Streams_Tool canvas_depth">
			<br>
			<h1>Strategy</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Structure</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Value Driven Strategy</div>
						<li id="list_2"><div><span class="disclose"><span></span></span>Freemium</div>
					</ol>
					<li id="list_1"><div><span class="disclose"><span></span></span>Revenue Streams</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Tiered Subscription package: annual</div>
					</ol>
				</ol>
			</div>
		</div>	
		
		<div id="Revenue_Type" class="Revenue_Streams_Tool canvas_depth">
			<br>
			<h1>Market Type</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_2"><div><span class="disclose"><span></span></span>Segmented market</div>
					<li id="list_2"><div><span class="disclose"><span></span></span>Emerging Market</div>
					<li id="list_2"><div><span class="disclose"><span></span></span>Mass Market</div>
				</ol>
			</div>
		</div>	
		
		<div id="Revenue_Total_Market" class="Revenue_Streams_Tool canvas_depth">
			<br>
			<h1>Total Market</h1>
			<div class="canvas_content">
					<strong>Total Available Market:</strong><br>
					<input class="" type="text" name="FirstName" size="9" value="20,000"><br>
					<strong>Total Serviceable Market per year:</strong><br>
					<input class="" type="text" name="FirstName" size="9" value="9,000"><br>
			</div>
		</div>
		
		<div id="Revenue_Pricing" class="Revenue_Streams_Tool canvas_depth">
			<br>
			<h1>Pricing</h1>
			<div class="canvas_content">
				<ol class="sortable">
				<li id="list_1"><div><span class="disclose"><span></span></span>Fixed</div>
					<ol>
					<li id="list_1"><div><span class="disclose"><span></span></span>Subscriptions</div>
					<ol>
						<li id="list_2"><div><span class="disclose"><span></span></span>Monthly/Yearly</div>
						<ol>
							<li id="list_3"><div><span class="disclose"><span></span></span>Start-Ups €150/year</div>
							<li id="list_3"><div><span class="disclose"><span></span></span>SMEs (under 50) €300+/year</div>
						</ol>
					</ol>
					</ol>
				</ol>
			</div>
		</div>
		

		
		<div id="Key_Resources" class="canvas_section">
			<img class="section_background" src="img/resources-section.png">
			<div class="canvas_content">
											<!--resources button-->
					<button id="create-resource">Create resource</button>

				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Government grants</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Angel Investment</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Advisors: Prof. Majella Giblins</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Mentors: Ruth Kearney, Sean Blanchfield</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Employees: Lead Developer, Lead Designer</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>DISCE™ Prototype/platform</div>
					
				</ol>
			</div>
		</div>
		
		<div id="Resources_Financial" class="Key_Resources_Tool canvas_depth">
			<br>
			<h1>Financial</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Capital</div>
					<ol>
						<li id="list_1"><div><span class="disclose"><span></span></span>Government grants</div>
						<li id="list_1"><div><span class="disclose"><span></span></span>Angel Investment</div>
					</ol>
					<li id="list_1"><div><span class="disclose"><span></span></span>Assets</div>
					<ol>
						<li id="list_1"><div><span class="disclose"><span></span></span>IT Infrastructure</div>
						<li id="list_1"><div><span class="disclose"><span></span></span>Premises</div>
					</ol>
				</ol>
			</div>
		</div>	
		
		<div id="Resources_Human" class="Key_Resources_Tool canvas_depth">
			<br>
			<h1>Human</h1>

			<div class="canvas_content">
					<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Advisors: Prof. Majella Giblins</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Mentors: Ruth Kearney, Sean Blanchfield</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Employees: Lead Developer, Lead Designer</div>
					
				</ol>
			</div>
		</div>	
		
		<div id="Resources_Intellectual" class="Key_Resources_Tool canvas_depth">
			<br>
			<h1>Intellectual</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>DISCE™ Prototype/platform</div>
					
				</ol>
			</div>
		</div>
	
		<div id="Key_Activities" class="canvas_section">
			<img class="section_background" src="img/activities-section.png">
			<div class="canvas_content">
							<!--activities button-->
					<button id="create-activity">Create activity</button>

				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Business Model Development</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Platform/Tool Development</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Angel meetings</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Government agency contacts</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Staffing necessary positions</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Partner Liaising</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Marketing</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Sales</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Customer service</div>

				</ol>
			</div>

		</div>
		
				
		<div id="Key_Activities_Product_Dev" class="Key_Activities_Tool canvas_depth">
			<br>
			<h1>Product/Service Development</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Business Model Development</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Platform/Tool Development</div>
				</ol>
			</div>
		</div>	
		
				
		<div id="Key_Activities_Capital" class="Key_Activities_Tool canvas_depth">
			<br>
			<h1>Raising Capital</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Business Model Generation</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Angel meetings</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Government agency contacts</div>
				</ol>
			</div>
		</div>	
		
				
		<div id="Key_Activities_Team" class="Key_Activities_Tool canvas_depth">
			<br>
			<h1>Team Building</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Interviewing prospective employees</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Staffing necessary positions</div>
				</ol>
			</div>
		</div>	
		
		<div id="Key_Activities_Channel_Dev" class="Key_Activities_Tool canvas_depth">
			<br>
			<h1>Channel Development</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Partner Liaising</div>

				</ol>
			</div>
		</div>	
		
		<div id="Key_Activities_Customer_Acq" class="Key_Activities_Tool canvas_depth">
			<br>
			<h1>Customer Acquisition</h1>
			<div class="canvas_content">
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Marketing</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Sales</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Customer service</div>

				</ol>
			</div>
		</div>	
		
		
		<div id="Cost_Structure" class="canvas_section">
			<img class="section_background" src="img/costs-section.png">
			<div class="canvas_content">
			<!--cost button-->
					<button id="create-cost">Create cost</button>
				<ol class="sortable">
					<li id="list_1"><div><span class="disclose"><span></span></span>Prototype - €3,000 <img class="selected_element" src="img/arrow.png" height="20"></div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Minimal Viable Product (MVP)- €150,000</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Start-up - €280,000</div>
					<li id="list_1"><div><span class="disclose"><span></span></span>Scale-up - €250,000</div>
				</ol>
			</div>
		</div>
		
		<div id="Cost_Breakdown" class="Cost_Structure_Tool canvas_depth">
			<br>
			<h1>Prototype Cost Breakdown</h1>
			<div class="canvas_content">
				<strong>Fixed Costs:</strong><br>
					<ol class="sortable">
						<li id="list_1"><div><span class="disclose"><span></span></span>Developer - €2,500</div>
						<li id="list_1"><div><span class="disclose"><span></span></span>Designer - €500</div>
					</ol>
				<br><br>
				<br><br>
				<strong>Variable Costs:</strong><br>
					<ol class="sortable">
					</ol>
				<br><br>
				<br><br>
				<strong>Funding Requirements(per year):</strong><br>
						<input type="text" size="10" id="" value="3,000">
			</div>
		</div>	
			
		
	</div>
	
	<div class="canvas_blocker"></div>	
	<div id="page_logo">
			<img class="page_logo" src="http://disce.ie/wp-content/uploads/2013/09/logo5-hi-res-black-with-TM--300x300.png">
	</div>
	<!-- menu section -->
	<div id="menu">
		

		<ul>
		<li>
			<a href="#Customer_Segments" class="Customer_Segments">
				<img class="section_icon_customer" src="img/customer-icon.png">
			</a>
		</li>
		<li>
			<a href="#Value_Proposition" class="Value_Proposition">
				<img class="section_icon_value" src="img/value-icon.png">
			</a>
		</li>
		<li>
			<a href="#Customer_Relationships" class="Customer_Relationships">
				<img class="section_icon_relationships" src="img/relationships-icon.png">
			</a>
		</li>
		<li>
			<a href="#Channels" class="Channels">
				<img class="section_icon_channels" src="img/channels-icon.png">
			</a>
		</li>
		<li>
			<a href="#Revenue_Streams" class="Revenue_Streams">
				<img class="section_icon_revenu" src="img/revenue-icon.png">
			</a>
		</li>
		<li>
			<a href="#Key_Partners" class="Key_Partners">
				<img class="section_icon_partners" src="img/partners-icon.png">
			</a>
		</li>
		<li>
			<a href="#Key_Resources" class="Key_Resources">
				<img class="section_icon_resources" src="img/resources-icon.png">
			</a>
		</li>
		<li>
			<a href="#Key_Activities" class="Key_Activities">
				<img class="section_icon_activites" src="img/activities-icon.png">
			</a>
		</li>
		<li>
			<a href="#Cost_Structure" class="Cost_Structure">
				<img class="section_icon_cost" src="img/costs-icon.png">
			</a>
		</li>

		</ul>

		
	</div>	
	<div id="notifications"></div>

	<!-- forms input -->
	
	<div id="create_segment_form" title="Create new segment">
		<p class="validateTips">All form fields are required.</p>
		<form name="create_segment_form" action="canvas.php" method="post">
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
			</fieldset>
			<input type="submit" name = "customer_segment-submit" value="Submit" />
		</form>
	</div>
	
	<div id="create_customer_form" title="Create new customer">
		<p class="validateTips">All form fields are required.</p>
		<form>
				<!-- Thea adding drop down menu -->
				<select name ="customer_dropdown">
					<option value="startup">Start Up</option>
					<option value="established">Established company</option>
				</select>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				<label for="age">Age</label>
				<input type="text" name="age" id="age" value="" class="text ui-widget-content ui-corner-all">
				<label for="location">Location</label>
				<input type="location" name="location" id="location" value="" class="text ui-widget-content ui-corner-all">
				<label for="gender">Gender</label>
				<input type="gender" name="gender" id="gender" value="" class="text ui-widget-content ui-corner-all">
				<label for="income">Income</label>
				<input type="income" name="income" id="income" value="" class="text ui-widget-content ui-corner-all">
				<label for="occupation">Occupation</label>
				<input type="occupation" name="occupation" id="occupation" value="" class="text ui-widget-content ui-corner-all">
				<label for="education">Education</label>
				<input type="education" name="education" id="education" value="" class="text ui-widget-content ui-corner-all">
			</fieldset>
		</form>
	</div>
	
	<div id="create_relationship_form" title="Create new relationship">
		<p class="validateTips">All form fields are required.</p>
		<form>
				<!-- Thea adding drop down menu -->
				<select name ="customer_dropdown">
					<option value="paid">paid</option>
					<option value="earned">Earned</option>
				</select>
			<fieldset>
				<label for="get">Get</label>
				<input type="text" name="get" id="get" class="text ui-widget-content ui-corner-all">
				<label for="keep">Kepp</label>
				<input type="text" name="keep" id="keep" value="" class="text ui-widget-content ui-corner-all">
				<label for="grow">Grow</label>
				<input type="grow" name="grow" id="grow" value="" class="text ui-widget-content ui-corner-all">
			</fieldset>
		</form>
	</div>
	
	<div id="create_channel_form" title="Create new channel">
		<p class="validateTips">All form fields are required.</p>
		<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				<!-- not sure what to put in here -->
			</fieldset>
		</form>
	</div>
	
	<div id="create_cost_form" title="Create new cost">
		<p class="validateTips">All form fields are required.</p>
		<form>
			<fieldset>
				<label for="fixed_cost">Fixed cost</label>
				<input type="text" name="fixed_cost" id="fixed_cost" class="text ui-widget-content ui-corner-all">
				<label for="variable_cost">Variable cost</label>
				<input type="text" name="variable_cost" id="variable_cost" value="" class="text ui-widget-content ui-corner-all">
			</fieldset>
		</form>
	</div>

		<div id="create_activity_form" title="Create new activity">
		<p class="validateTips">All form fields are required.</p>
		<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
			</fieldset>
		</form>
	</div>
	
			<div id="create_resource_form" title="Create new resource">
		<p class="validateTips">All form fields are required.</p>
		<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
			</fieldset>
		</form>
	</div>
	
			<div id="create_partner_form" title="Create new partner">
		<p class="validateTips">All form fields are required.</p>
		<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
			</fieldset>
		</form>
	</div>

	<div id="create_revenue_stream_form" title="Create new revenue stream">
		<p class="validateTips">All form fields are required.</p>
		<form>
			<fieldset>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
			</fieldset>
		</form>
	</div>

		<script>
		
		
		$(document).ready(function(){
		
			$('ol.sortable').nestedSortable({
				forcePlaceholderSize: true,
				handle: 'div',
				helper:	'clone',
				items: 'li',
				opacity: .6,
				placeholder: 'placeholder',
				revert: 250,
				tabSize: 25,
				tolerance: 'pointer',
				toleranceElement: '> div',
				maxLevels: 3,
				isTree: true,
				expandOnHover: 700,
				startCollapsed: true
			});

			$('.disclose').on('click', function() {
				$(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
			})

			// functions for menu
			$('.Customer_Segments').on('click', function() {	
					
				if($('#Customer_Segments').hasClass('canvas_focused')){
					GoToModel();								
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();	
					$('#Customer_Segments').addClass('canvas_focused');	
					$('.Customer_Segments_Tool').show('slide', {direction: 'left'}, 750);
					//~Thea adding highlighting
					$('.section_icon_customer').removeClass('section_icon_customer').addClass('section_icon_selected_customer');				
				}
			})	

			
			$('.Value_Proposition').on('click', function() {
										
				if($('#Value_Proposition').hasClass('value_canvas_focused')){
					GoToModel();				
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();	
					$('.Value_Proposition_Tool').show('slide', {direction: 'left'}, 750);						
					$('.Value_product_heading').show();									
					$('#Value_Proposition').addClass('value_canvas_focused');	
					$('.PitchValueSelect').show();
					$('.PitchValue').hide();
					//~Thea adding highlighting
					$('.section_icon_value').removeClass('section_icon_value').addClass('section_icon_selected_value');
					
				}

			})	
			
			$('.Customer_Relationships').on('click', function() {
					
				if($('#Customer_Relationships').hasClass('canvas_focused')){
					GoToModel();						
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();		
					$('#Customer_Relationships').addClass('canvas_focused');
					$('.Customer_Relationships_Tool').show('slide', {direction: 'left'}, 750);
					//~Thea adding highlighting
					$('.section_icon_relationships').removeClass('section_icon_relationships').addClass('section_icon_selected_relationships');
				
				}

			})		
			
			$('.Channels').on('click', function() {
					
				if($('#Channels').hasClass('canvas_focused')){
					GoToModel();					
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();		
					$('#Channels').addClass('canvas_focused');	
					$('.Channels_Tool').show('slide', {direction: 'left'}, 750);	
					init_Chan_eco();	
					//~Thea adding highlighting
					$('.section_icon_channels').removeClass('section_icon_channels').addClass('section_icon_selected_channels');		
				}

			})			
			
			$('.Revenue_Streams').on('click', function() {
					
				if($('#Revenue_Streams').hasClass('canvas_focused')){
					GoToModel();					
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();	
					$('#Revenue_Streams').addClass('canvas_focused');	
					$('.Revenue_Streams_Tool').show('slide', {direction: 'left'}, 750);			
					//~Thea adding highlighting
					$('.section_icon_revenu').removeClass('section_icon_revenu').addClass('section_icon_selected_revenu');	
				}

			})			
			
			$('.Key_Partners').on('click', function() {
					
				if($('#Key_Partners').hasClass('canvas_focused')){
					GoToModel();					
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();		
					$('#Key_Partners').addClass('canvas_focused');	
					$('.Key_Partners_Tool').show('slide', {direction: 'left'}, 750);
					//~Thea adding highlighting
					$('.section_icon_partners').removeClass('section_icon_partners').addClass('section_icon_selected_partners');
			
				}

			})			
			
			$('.Key_Resources').on('click', function() {
					
				if($('#Key_Resources').hasClass('canvas_focused')){
					GoToModel();					
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();		
					$('#Key_Resources').addClass('canvas_focused');
					$('.Key_Resources_Tool').show('slide', {direction: 'left'}, 750);		
					//~Thea adding highlighting
					$('.section_icon_resources').removeClass('section_icon_resources').addClass('section_icon_selected_resources');
			
				}

			})	
			
			$('.Key_Activities').on('click', function() {
					
				if($('#Key_Activities').hasClass('canvas_focused')){
					GoToModel();					
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();	
					$('#Key_Activities').addClass('canvas_focused');					
					$('.Key_Activities_Tool').show('slide', {direction: 'left'}, 750);	
					//~Thea adding highlighting			
					$('.section_icon_activites').removeClass('section_icon_activites').addClass('section_icon_selected_activites');
				}

			})	
			
			
			$('.Cost_Structure').on('click', function() {
					
				if($('#Cost_Structure').hasClass('canvas_focused')){
					GoToModel();					
				}else{
					GoToModel();
					$('.canvas_focused').removeClass('canvas_focused');
					$('.canvas_blocker').show();		
					$('#Cost_Structure').addClass('canvas_focused');	
					$('.Cost_Structure_Tool').show('slide', {direction: 'left'}, 750);	
					//~Thea adding highlighting
					$('.section_icon_cost').removeClass('section_icon_cost').addClass('section_icon_selected_cost');					
				}

			})	
			
			$('.canvas_blocker').on('click', function() {
				GoToModel();
			})
			
			$( ".CAC" ).change(function() {
			
				if($('#CAC_cost').val()==0 | $('#CAC_audience').val()==0 | $('#CAC_sales').val()==0){
				
				}else{
						$('#CustomerAcquisitionCost').val(($('#CAC_cost').val()*$('#CAC_audience').val())/(($('#CAC_audience').val()*$('#CAC_sales').val())/100));
						$('#Lifetime_profit').val($('#LifetimeValue').val()-$('#CustomerAcquisitionCost').val());		
				}
			

			});
			
			$( ".LV" ).change(function() {
				$('#LifetimeValue').val($('#LV_lifetime').val()*$('#LV_payment').val());
				$('#Lifetime_profit').val($('#LifetimeValue').val()-$('#CustomerAcquisitionCost').val());
			}); 
			


		});
		function init_Chan_eco(){
			$("#Channel_Eco_Direct").colResizable({
				liveDrag:true,
				gripInnerHtml:"<div class='grip'></div>", 
				draggingClass:"Chan_Eco_dragging", 
				onResize:onSampleResized,
				onDrag: onChan_Eco_Drag
			 });
			$("#Channel_Eco_OEM").colResizable({
				liveDrag:true,
				gripInnerHtml:"<div class='grip'></div>", 
				draggingClass:"Chan_Eco_dragging", 
				onResize:onSampleResized,
				onDrag: onChan_Eco_Drag
			 });
			 $("#Channel_Eco_Indirect").colResizable({
				liveDrag:true,
				gripInnerHtml:"<div class='grip'></div>", 
				draggingClass:"Chan_Eco_dragging", 
				onResize:onSampleResized,
				onDrag: onChan_Eco_Drag
			 });
		}
		
		var onChan_Eco_Drag = function(e){  
			var table = $(e.currentTarget).attr('id'); //reference to the resized table
			var width = $(e.currentTarget).width();
			$('.'+table).each(function() {
			  var list_price = $('#Chan_Eco_list_price').val();
			  var this_width = $( this ).width();
			  var percentage = (this_width/width);
			  var cost = list_price*percentage;
			  $(this).children('.chan_eco_value').text(Math.round((cost*10))/10);
			});

		 }; 	
		 
		var onSampleResized = function(e){  
			var table = $(e.currentTarget); //reference to the resized table
		 }; 

		 //seems to just hide everything ~Thea
  
		function GoToModel(){
			$('.canvas_blocker').hide();
			$('.canvas_focused').removeClass('canvas_focused');
			$('#Value_Proposition').removeClass('value_canvas_focused');
			$('#Customer_Relationships').removeClass('relationship_canvas_focused');	
			$('.relationship_contents').children('li').removeClass('relationshipLists');
			$('#Value_Pains').hide();	
			$('#Value_Gains').hide();
			$('#Value_Features').hide();					
			$('#Value_Comp').hide();					
			$('#Relationship_cost').hide();					
			$('#Value_flow').hide();	
			$('.Value_product_heading').hide();	
			$('.PitchValueSelect').hide();
			$('.PitchValueSelect').each(function() {
			  $value = $( this ).val()
			  $( this ).prev().html($value );
			});
			$('.PitchValue').show();
			$('#Channels').removeClass('canvas_focused');	
			$('#Customer_Segments').removeClass('canvas_focused');	
			$('#Customer_personas').hide();		
			$('#Customer_Relationships').removeClass('canvas_focused');		
			$('#Channel_economics').hide();	
			$("#Channel_Eco_OEM").colResizable({
				disable:true
			 });
			$('#Relationship_Get').hide();	
			$('#Relationship_Keep').hide();
			$('#Relationship_Grow').hide();	
			$('#Revenue_Strategy').hide();
			$('#Revenue_Type').hide();
			$('#Revenue_Total_Market').hide();
			$('#Revenue_Pricing').hide();	
			
			$('#Key_Partners_Details').hide();	
			
			$('.Key_Activities_Tool').hide();	
			
			$('#Cost_Breakdown').hide();	
			
			$('#Resources_Financial').hide();	;	
			$('#Resources_Human').hide();	
			$('#Resources_Intellectual').hide();	

			//~Thea adding highlighting

			$('.section_icon_selected_partners').removeClass('section_icon_selected_partners').addClass('section_icon_partners');
			$('.section_icon_selected_channels').removeClass('section_icon_selected_channels').addClass('section_icon_channels');
			$('.section_icon_selected_customer').removeClass('section_icon_selected_customer').addClass('section_icon_customer');
			$('.section_icon_selected_relationships').removeClass('section_icon_selected_relationships').addClass('section_icon_relationships');
			$('.section_icon_selected_value').removeClass('section_icon_selected_value').addClass('section_icon_value');
			$('.section_icon_selected_activites').removeClass('section_icon_selected_activites').addClass('section_icon_activites');
			$('.section_icon_selected_resources').removeClass('section_icon_selected_resources').addClass('section_icon_resources');
			$('.section_icon_selected_cost').removeClass('section_icon_selected_cost').addClass('section_icon_cost');
			$('.section_icon_selected_revenu').removeClass('section_icon_selected_revenu').addClass('section_icon_revenu');
		
		}
		
	
		

		jQuery.fn.center = function () {
			this.css("position","absolute");
			this.css("position","absolute");
			this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
														$(window).scrollTop()) + "px");
			this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
														$(window).scrollLeft()) + "px");
			return this;


		}

	$(function() {
		var name = $( "#name" ),
		email = $( "#email" ),
		password = $( "#password" ),
		allFields = $( [] ).add( name ).add( email ).add( password ),
		tips = $( ".validateTips" );
	function updateTips( t ) {
		tips
		.text( t )
		.addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 1500 );
		}, 500 );
	}
	function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			updateTips( "Length of " + n + " must be between " +
			min + " and " + max + "." );
			return false;
		}
		else {
			return true;
		}
	}
	function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		} 
		else {
			return true;
		}
	}
	
	function myAjax() {
		$.ajax({
			type: 'POST',
			url: 'canvas_submit.php',
			data: {action:'segment_submit'},
			success: function(data){
				alert(data);//data returned from php
		   }
		});
	}
	
	/*
	 * Canvas Buttons
	 */
	$( "#create_segment_form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: {
			"Submit": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				bValid = bValid && checkLength( name, "name", 0, 255 );
				bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "feilds may consist of a-z, 0-9, underscores, begin with a letter." );
				if ( bValid ) {
					//myAjax();
					//document.location.href = '/canvas_submit.php';
					//document.create_segment_form.submit();
					document.getElementById("customer_segment-submit").submit();
					$( this ).dialog( "close" );
				}
		},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	$( "#create-segment" )
		.button()
		.click(function() {
			$( "#create_segment_form" ).dialog( "open" );
		});
	
	$( "#create_customer_form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: {
			"Submit": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				bValid = bValid && checkLength( name, "name", 0, 255 );
				bValid = bValid && checkLength( age, "age", 0, 255 );
				bValid = bValid && checkLength( location, "location", 0, 255 );
				bValid = bValid && checkLength( gender, "gender", 0, 255 );
				bValid = bValid && checkLength( age, "age", 0, 255 );
				bValid = bValid && checkLength( income, "income", 0, 255 );
				bValid = bValid && checkLength( occupation, "occupation", 0, 255 );
				bValid = bValid && checkLength( education, "education", 0, 255 );
				if ( bValid ) {
					$( "#users tbody" ).append( "<tr>" +
						"<td>" + name.val() + "</td>" +
						"<td>" + email.val() + "</td>" +
						"<td>" + password.val() + "</td>" +
						"</tr>" );
					$( this ).dialog( "close" );
				}
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	$( "#create-customer" )
		.button()
		.click(function() {
			$( "#create_customer_form" ).dialog( "open" );
		});

$( "#create_relationship_form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: {
			"Create an customer": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				bValid = bValid && checkLength( name, "username", 3, 16 );
				bValid = bValid && checkLength( email, "email", 6, 80 );
				bValid = bValid && checkLength( password, "password", 5, 16 );
				bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
				// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
				bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
				bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
			if ( bValid ) {
				$( "#users tbody" ).append( "<tr>" +
					"<td>" + name.val() + "</td>" +
					"<td>" + email.val() + "</td>" +
					"<td>" + password.val() + "</td>" +
					"</tr>" );
				$( this ).dialog( "close" );
			}
		},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	$( "#create-relationship" )
		.button()
		.click(function() {
	$( "#create_relationship_form" ).dialog( "open" );
		});
	});

$( "#create_channel_form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: {
			"Create an channel": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				bValid = bValid && checkLength( name, "username", 3, 16 );
				bValid = bValid && checkLength( email, "email", 6, 80 );
				bValid = bValid && checkLength( password, "password", 5, 16 );
				bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
				// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
				bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
				bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
			if ( bValid ) {
				$( "#users tbody" ).append( "<tr>" +
					"<td>" + name.val() + "</td>" +
					"<td>" + email.val() + "</td>" +
					"<td>" + password.val() + "</td>" +
					"</tr>" );
				$( this ).dialog( "close" );
			}
		},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	$( "#create-channel" )
		.button()
		.click(function() {
	$( "#create_channel_form" ).dialog( "open" );
		});

$( "#create_cost_form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: {
			"Create a new cost": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				bValid = bValid && checkLength( name, "username", 3, 16 );
				bValid = bValid && checkLength( email, "email", 6, 80 );
				bValid = bValid && checkLength( password, "password", 5, 16 );
				bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
				// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
				bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
				bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
			if ( bValid ) {
				$( "#users tbody" ).append( "<tr>" +
					"<td>" + name.val() + "</td>" +
					"<td>" + email.val() + "</td>" +
					"<td>" + password.val() + "</td>" +
					"</tr>" );
				$( this ).dialog( "close" );
			}
		},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	$( "#create-cost" )
		.button()
		.click(function() {
	$( "#create_cost_form" ).dialog( "open" );
		});


$( "#create_activity_form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 350,
		modal: true,
		buttons: {
			"Create an activity": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				bValid = bValid && checkLength( name, "username", 3, 16 );
				bValid = bValid && checkLength( email, "email", 6, 80 );
				bValid = bValid && checkLength( password, "password", 5, 16 );
				bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
				// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
				bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
				bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
			if ( bValid ) {
				$( "#users tbody" ).append( "<tr>" +
					"<td>" + name.val() + "</td>" +
					"<td>" + email.val() + "</td>" +
					"<td>" + password.val() + "</td>" +
					"</tr>" );
				$( this ).dialog( "close" );
			}
		},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	$( "#create-activity" )
		.button()
		.click(function() {
	$( "#create_activity_form" ).dialog( "open" );
		});



$( "#create_resource_form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Create a new resource": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
					bValid = bValid && checkLength( name, "username", 3, 16 );
					bValid = bValid && checkLength( email, "email", 6, 80 );
					bValid = bValid && checkLength( password, "password", 5, 16 );
					bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
					bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
				if ( bValid ) {
					$( "#users tbody" ).append( "<tr>" +
						"<td>" + name.val() + "</td>" +
						"<td>" + email.val() + "</td>" +
						"<td>" + password.val() + "</td>" +
						"</tr>" );
					$( this ).dialog( "close" );
				}
			},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
		$( "#create-resource" )
			.button()
			.click(function() {
		$( "#create_resource_form" ).dialog( "open" );
			});
	
	$( "#create_partner_form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Create a new partner": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
					bValid = bValid && checkLength( name, "username", 3, 16 );
					bValid = bValid && checkLength( email, "email", 6, 80 );
					bValid = bValid && checkLength( password, "password", 5, 16 );
					bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
					bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
				if ( bValid ) {
					$( "#users tbody" ).append( "<tr>" +
						"<td>" + name.val() + "</td>" +
						"<td>" + email.val() + "</td>" +
						"<td>" + password.val() + "</td>" +
						"</tr>" );
					$( this ).dialog( "close" );
				}
			},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
		$( "#create-partner" )
			.button()
			.click(function() {
		$( "#create_partner_form" ).dialog( "open" );
			});


				$( "#create_revenue_stream_form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Create a new revenue stream": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
					bValid = bValid && checkLength( name, "username", 3, 16 );
					bValid = bValid && checkLength( email, "email", 6, 80 );
					bValid = bValid && checkLength( password, "password", 5, 16 );
					bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
					bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
				if ( bValid ) {
					$( "#users tbody" ).append( "<tr>" +
						"<td>" + name.val() + "</td>" +
						"<td>" + email.val() + "</td>" +
						"<td>" + password.val() + "</td>" +
						"</tr>" );
					$( this ).dialog( "close" );
				}
			},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
		$( "#create-revenue-stream" )
			.button()
			.click(function() {
		$( "#create_revenue_stream_form" ).dialog( "open" );
			});


	
	</script>
	
</body>
</html>