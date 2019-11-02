<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<thead>
		    <tr style="text-align: center;">
				<th style="border-right: 3px solid #f2f2f2;"><?php  AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')); ?></th>
				<th style="padding-left: 15px;">{{ AdminOptions::lang(104, Session::get('jezik.AdminOptions::server()')) }}</th>
				<th>{{ AdminOptions::lang(124, Session::get('jezik.AdminOptions::server()')) }}</th>
				<th>{{ AdminOptions::lang(125, Session::get('jezik.AdminOptions::server()')) }}</th>
				<th>{{ AdminOptions::lang(126, Session::get('jezik.AdminOptions::server()')) }}</th>
			</tr>
	  	</thead>
		<tbody>
			<tr>
				<td>
					1
	            </td>
	            <td>
	                2
	            </td>
	            <td>
	                3
	            </td>
	            <td>
	                4
	            </td>
			</tr>
		</tbody>
	</table>

</body>
</html>