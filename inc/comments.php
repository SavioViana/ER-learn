<h2 class="text-center">Duvidas</h2>
<!--
<div class="comments">
	<h2>Comentati 01</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	<div class="">
		<div class="row">
			<div class="col-md-2 text-right">
				<i class="fab fa-android"></i>
			</div>

			<div class="col-md-10 comments-answer">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2 text-right">
				<i class="fab fa-android"></i>
			</div>

			<div class="col-md-10 comments-answer">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>
		
	</div>

	<form class="">

		<div class="row">
			<div class="col-md-10">
				 <div class="form-group">
				    <textarea class="form-control" placeholder="Reponda uma duvida" id="descricao" rows="2"></textarea>
				 </div>
			</div>

			<div class="col-md-2 text-center">	
			  	<a href="#" class="btn btn-success">Enviar</a>
			</div>
		</div>
	  
	</form>

	<a href="#"> Responder</a>
</div>

-->


<?php foreach ($comments as $key => $comment) { ?>


<div class="comments">
	<h2><?php echo($comment->comments_title) ?></h3>

	<p><?php echo($comment->comments_description) ?></p>


	<?php 
		$answers = $commentsObj->getComments($idActivity, $comment->comments_id);


	?>
	

	<div class="comments-answers">
		<?php foreach ($answers as $key => $answer) { ?>

		<!--
		<div class="row">
			<div class="col-md-2 text-right">	
				<?php if( $answer->fk_user == $currentUser->user_id){ ?>
					<i class="fab fa-android"></i>
				<?php }else{?>
					<i class="fas fa-address-book"></i>
				<?php } ?>
				
			</div>

			<div class="col-md-10 comments-answer">
				<p><?php echo($answer->comments_description) ?></p>
			</div>
		</div>
		-->
			<?php if( $answer->fk_user == $currentUser->user_id){ ?>
			<div class="row">
				<div class="col-md-2 text-right">	
					
						
					
				</div>

				<div class="col-md-10 comments-answer">
					<p><?php echo($answer->comments_description) ?></p>
				</div>
			</div>

			<?php }else{?>

					<div class="row">
						<div class="col-md-10 comments-answer">	
								<p><?php echo($answer->comments_description) ?></p>

						</div>

						<div class="col-md-2 text-left ">
						
						</div>
					</div>

				<?php } ?>

		<?php } ?>			
		
	</div>


	<form id="commentsFormAnswer" onsubmit=" return enviarAnswer(this)">

		<div class="row">
			<div class="col-md-10">
				 <div class="form-group">
				    <textarea class="form-control" name="description-answer" placeholder="Reponda uma duvida" id="descricao" rows="2"></textarea>
				    <input type="hidden" name="comments-id" value="<?php echo "$comment->comments_id"; ?>">
				    <input type="hidden" name="activity-id" value="<?php echo($idActivity) ?>">
				 </div>
			</div>

			<div class="col-md-2 text-center">	
				<button class="btn btn-success">Enviar</button>
		
			</div>
		</div>
	  
	  <div class="formAnswerAjax"></div>
	</form>

	

</div>

<?php } ?>


<!--fazer uma nova duvida-->
<form class="form-comments" id="commentsForm" onsubmit="return enviar();">
  <div class="form-group">
    <label for="title">Titulo</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Titulo">
  </div>

  <div class="form-group">
    <label for="description">Descrição</label>
    <textarea class="form-control" id="description" name="description" placeholder="Descrição" rows="2"></textarea>
  </div>

 

  <div id="ajaxResultComments"></div>

  <div class="text-right">
  	<input type="hidden" name="fkActivity" value="<?php echo($_GET['activity_id']) ?>">
  	<button class="btn btn-success btn-lg" >Enviar</button>
  </div>
  
</form>
