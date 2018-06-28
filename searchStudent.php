<?php 

require "class/user.php";

$term = isset($_GET['term']) ? $_GET['term'] : "";

if (empty($term)){
	echo "<div class='alert alert-danger'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Entre com um valor valido!</div>
		</script>";

}else {

	$student = new User();
	$data = $student->searchStudent($term);
	//print_r($data);

	
		
	


		echo"    		<table class='table table-hover'>
    					<thead>
    						<th scope='col'>#</th>
    						<th scope='col'>nome</th>
    						<th scope='col'>email</th>
    						<th scope='col'></th>

    					</thead><!--/thead-->

    					<tbody>" ;

    					foreach ($data as $key => $value) {
    						echo"
    						<tr>
    							<th scope='row'>$key</th>
    							<td>$value->user_name</td>
    							<td>$value->user_email</td>
    							<td>
    								<button class='btn btn-outline-success' onclick='add($value->user_id)'>Add</button>
    							</td>
    						</tr>";
			    		}
			    		echo"				
    					</tbody><!--/tbody-->
    				</table><!--/table-->";
    			
}



/*
    				<table class="table table-hover">
    					<thead>
    						<th scope="col">#</th>
    						<th scope="col">Alunos</th>
    						<th scope="col">Alunos</th>
    					</thead><!--/thead-->

    					<tbody>
    						<tr>
    							<th scope="row">1</th>
    							<td>asgdsadgh@dsadh.com</td>
    							<td>
    								<a href="#" class="btn btn-outline-success">Add</a>
    							</td>
    						</tr>
			    						
    					</tbody><!--/tbody-->
    				</table><!--/table-->
    				*/
 ?>