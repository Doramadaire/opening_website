<!DOCTYPE html>
<html>
	<head>
        <?php include("include/html_header.php"); ?>
        <title>Opening</title>
        <!-- Import des fichiers spécifiques à cette page -->
        <link rel="stylesheet" href="css/user_management.css" type="text/css">	
	</head>	
	<body>
	
<!-- Le container est déjà sur la page admin-->
<div class="container-fluid">  




<!-- L'objet table : code à copier-->
<table class="table table-hover">

	<!-- La premiere ligne-->
	<thead>
		<tr>
			<!-- Le nom des colonnes et leur taille bootstrap (pour les valeurs visible lors de la recherche) -->
			<th class="col-md-3">#</th>
			<th class="col-md-3">Colonne1</th>
			<th class="col-md-3">Colonne2</th>
			<th class="col-md-3">Colonne3</th>
		</tr>
	</thead>
	
	<!-- Le corps de la table-->
	<tbody>
		<!-- Un clic sur la ligne déclenche les actions "afficher les lignes ayant les id maj et data
		Il faut rajouter ici l'id de l'user à  "maj" et "data"
		Pour que les id restent uniques
		-->
		
		<!-- Les valeurs visibles de base-->
		<tr onclick="hideRow('maj');hideRow('data')">
			<th scope="row">1</th>
			<td>Mark</td>
			<td>Otto</td>
			<td>@mdo</td>
		</tr>
		<!-- Les deux tr suivants sont les lignes qui votn s'afficher au clic -->
		<tr class="hide_first" id="data">
		
			<!-- Le rowspan ici sert à dire que les 2 tr suivants seront fusionnés-->
			<th scope="row" rowspan="2" >nom de ligne </th>
			<td> autre détail <br> data1 </td>
			<td> autre détail <br> data1 </td>
			<td> autre détail <br> data1 </td>
		</tr>
		
		<tr class="hide_first" id="maj">
		<!-- Le colspan ici sert à dire que les 3 colonnes de la table seront fusionnées dans cette ligne -->
			<td colspan="3" > <form action="" method="POST">
				<label for="user_type"></label>
				<input type="text" name="mail" placeholder="nom">
				<input type="text" name="mail" placeholder="prénom">
				<input type="text" name="mail" placeholder="mail">
				<input type="text" name="mail" placeholder="status">
				<input type="text" name="mail" placeholder="date de cotisation">
				<input type="submit" name="search_user_form" class="btn btn-primary" value="maj">	
			</td>
		</tr>
		

		<!-- Une autre ligne de données, les id maj et data deviennent maj1 et data1 -->		
		<tr onclick="hideRow('maj1');hideRow('data1')">
			<th scope="row">1</th>
			<td>Paul</td>
			<td>Dupont</td>
			<td>aaa</td>
		</tr>
		<!-- Les deux tr suivants sont les lignes qui votn s'afficher au clic -->
		<tr class="hide_first" id="data1">
		
			<!-- Le rowspan ici sert à dire que les 2 tr suivants seront fusionnés-->
			<th scope="row" rowspan="2" >nom de ligne </th>
			<td> autre détail <br> data1 </td>
			<td> autre détail <br> data1 </td>
			<td> autre détail <br> data1 </td>
		</tr>
		
		<tr class="hide_first" id="maj1">
		<!-- Le colspan ici sert à dire que les 3 colonnes de la table seront fusionnées dans cette ligne -->
			<td colspan="3" > <form action="" method="POST">
				<label for="user_type"></label>
				<input type="text" name="mail" placeholder="nom">
				<input type="text" name="mail" placeholder="prénom">
				<input type="text" name="mail" placeholder="mail">
				<input type="text" name="mail" placeholder="status">
				<input type="text" name="mail" placeholder="date de cotisation">
				<input type="submit" name="search_user_form" class="btn btn-primary" value="maj">	
			</td>
		</tr>
	</tbody>
</table>






<!-- le div de fin container n'est pas à copier -->
</div>

	
	</body>
</html>