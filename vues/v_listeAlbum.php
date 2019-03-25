<div class="container page">
	<div class="row">
		<div class="titre col-md-12">
			<h1>Vos Albums</h1>
		</div>
	</div>
		<section id="Albums" class="row">
	<?php
	foreach ($lesAlbums as $unAlbum)
	{
	?>
			<div class="col-sm-4 album-item">
				<a href="#" class="album-link" data-toggle="modal">
					<div class="caption">
						<div class="caption-content">
							<h2><?php echo $unAlbum['nom_image'];?></h2>
							<p><?php echo $unAlbum['description'];?></p>
						</div>
					</div>		
			<?php	echo "<img src='img/images/".$unAlbum['imageP']."'>";?>
				</a>
			</div>
	<?php
	}
	?>
		</section>
</div>