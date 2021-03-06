<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
	<div class="container">
        <div class="row">
		<div class="col-lg-3">
			<!-- nav -->
		</div>
            <div class="col-lg-9">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                    <th class="text-center"><span>Infos</span></th>
                                    <th class="text-center"><span>Size</span></th>
                                    <th class="text-center"><span>Weight</span></th>
                                    <th class="text-center"><span>Stock</span></th>
                                </tr>
                            </thead>
                            <tbody>
							<!-- Products = getProducts() -->
                        <? foreach ($products as $product): ?>
									<tr>
										<td>
											<img src="http://image.noelshack.com/fichiers/2021/25/6/1624720676-avatar1.png" alt="">
											<a class="link" href="http://<?="{$_SERVER['HTTP_HOST']}/products/{$product['id']}"?>">
												<p  class="user-link"><?= $product['name'] ?></p>
												<span class="user-subhead"><?= $product['description'] ?></span>
											</a>	
										</td>
										<td class="text-center">
											<span class="label label-default"><?= $product['size'] ?></span>
										</td>
										<td>
											<span class="label label-default"><?= $product['weight'] ?></span>
										</td>
										<td>
											<p><?= $product['quantity'] ?></p> 
										</td>
									</tr>
								</a>
                        <? endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
	.popup {
        visibility: hidden;
    }
	.form {
		z-index: 1;
		height: 400;
		weight: 400;
		position: fixed;
		top: 20%;
		left: 40%;
		background-color: #E4E3DF;
		padding: 10px;
		
		/* background-color: grey; */
	}

	.link{
		text-decoration: none; 
		color: black;
	}

	body{margin-top:20px;}


	/* USER LIST TABLE */
	.user-list tbody td > img {
		position: relative;
		max-width: 50px;
		float: left;
		margin-right: 15px;
	}
	.user-list tbody td .user-link {
		display: block;
		font-size: 1.25em;
		padding-top: 3px;
		margin-left: 60px;
	}
	.user-list tbody td .user-subhead {
		font-size: 0.875em;
		font-style: italic;
	}

	/* TABLES */
	.table {
		border-collapse: separate;
	}
	.table-hover > tbody > tr:hover > td,
	.table-hover > tbody > tr:hover > th {
		background-color: #eee;
	}
	.table thead > tr > th {
		border-bottom: 1px solid #C2C2C2;
		padding-bottom: 0;
	}
	.table tbody > tr > td {
		font-size: 0.875em;
		background: #f5f5f5;
		border-top: 10px solid #fff;
		vertical-align: middle;
		padding: 12px 8px;
	}
	.table tbody > tr > td:first-child,
	.table thead > tr > th:first-child {
		padding-left: 20px;
	}
	.table thead > tr > th span {
		border-bottom: 2px solid #C2C2C2;
		display: inline-block;
		padding: 0 5px;
		padding-bottom: 5px;
		font-weight: normal;
	}
	.table thead > tr > th > a span {
		color: #344644;
	}
	.table thead > tr > th > a span:after {
		content: "\f0dc";
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
		margin-left: 5px;
		font-size: 0.75em;
	}
	.table thead > tr > th > a.asc span:after {
		content: "\f0dd";
	}
	.table thead > tr > th > a.desc span:after {
		content: "\f0de";
	}
	.table thead > tr > th > a:hover span {
		text-decoration: none;
		color: #2bb6a3;
		border-color: #2bb6a3;
	}
	.table.table-hover tbody > tr > td {
		-webkit-transition: background-color 0.15s ease-in-out 0s;
		transition: background-color 0.15s ease-in-out 0s;
	}
	.table tbody tr td .call-type {
		display: block;
		font-size: 0.75em;
		text-align: center;
	}
	.table tbody tr td .first-line {
		line-height: 1.5;
		font-weight: 400;
		font-size: 1.125em;
	}
	.table tbody tr td .first-line span {
		font-size: 0.875em;
		color: #969696;
		font-weight: 300;
	}
	.table tbody tr td .second-line {
		font-size: 0.875em;
		line-height: 1.2;
	}
	.table a.table-link {
		margin: 0 5px;
		font-size: 1.125em;
	}
	.table a.table-link:hover {
		text-decoration: none;
		color: #2aa493;
	}
	.table a.table-link.danger {
		color: #fe635f;
	}
	.table a.table-link.danger:hover {
		color: #dd504c;
	}

	.table-products tbody > tr > td {
		background: none;
		border: none;
		border-bottom: 1px solid #ebebeb;
		-webkit-transition: background-color 0.15s ease-in-out 0s;
		transition: background-color 0.15s ease-in-out 0s;
		position: relative;
	}
	.table-products tbody > tr:hover > td {
		text-decoration: none;
		background-color: #f6f6f6;
	}
	.table-products .name {
		display: block;
		font-weight: 600;
		padding-bottom: 7px;
	}
	.table-products .price {
		display: block;
		text-decoration: none;
		width: 50%;
		float: left;
		font-size: 0.875em;
	}
	.table-products .price > i {
		color: #8dc859;
	}
	.table-products .warranty {
		display: block;
		text-decoration: none;
		width: 50%;
		float: left;
		font-size: 0.875em;
	}
	.table-products .warranty > i {
		color: #f1c40f;
	}
	.table tbody > tr.table-line-fb > td {
		background-color: #9daccb;
		color: #262525;
	}
	.table tbody > tr.table-line-twitter > td {
		background-color: #9fccff;
		color: #262525;
	}
	.table tbody > tr.table-line-plus > td {
		background-color: #eea59c;
		color: #262525;
	}
	.table-stats .status-social-icon {
		font-size: 1.9em;
		vertical-align: bottom;
	}
	.table-stats .table-line-fb .status-social-icon {
		color: #556484;
	}
	.table-stats .table-line-twitter .status-social-icon {
		color: #5885b8;
	}
	.table-stats .table-line-plus .status-social-icon {
		color: #a75d54;
	}
</style>

</html>