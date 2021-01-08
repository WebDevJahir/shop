<!DOCTYPE html>
<html>
<head>
	<title>Register Email</title>
</head>
<body>
	<table width="700px">
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('/images/backend_image/logo.png')}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Dear {{ $name }}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thanks for shopping with us. Your order details are as below:-</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Order No: {{$order_id}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table width="95%" cellpadding="5" cellspacing="5" bgcolor="#5d97e0">
				<tr>
					<td>Product Name</td>
					<td>Product Code</td>
					<td>Size</td>
					<td>Color</td>
					<td>Quantity</td>
					<td>Unit Price</td>
				</tr>
				@foreach($productDetails['orders'] as $product)
				<tr>
					<td>{{ $product['product_name'] }}</td>
					<td>{{ $product['product_code'] }}</td>
					<td>{{ $product['product_size'] }}</td>
					<td>{{ $product['product_color'] }}</td>
					<td>{{ $product['product_quantity'] }}</td>
					<td>{{ $product['product_price'] }}</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="5" align="right">Shipping Charges</td><td>TK {{$productDetails['shipping_charges']}}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Coupon Discount</td><td>TK {{$productDetails['coupon_amount']}}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Grand Total</td><td>TK {{$productDetails['grand_total'] + $productDetails['shipping_charges']}}</td>
				</tr>
			</table>
		</td></tr>
		<tr><td>
				<table width="100%">
					<tr>
						<td width="50%" bgcolor="gray">
							<table>
								<tr>
									<td>Bill To:-</td>
								</tr>
								<tr>
									<td>{{ $userDetails['name']}}</td>
								</tr>
								<tr>
									<td>{{ $userDetails['address']}}</td>
								</tr>
								<tr>
									<td>{{ $userDetails['city']}}</td>
								</tr>
								<tr>
									<td>{{ $userDetails['state']}}</td>
								</tr>
								<tr>
									<td>{{ $userDetails['country']}}</td>
								</tr>
								<tr>
									<td>{{ $userDetails['pincode']}}</td>
								</tr>
								<tr>
									<td>{{ $userDetails['mobile']}}</td>
								</tr>
							</table>
						</td>
						<td width="50%" bgcolor="gray">
							<table>
								<tr>
									<td>Ship To:-</td>
								</tr>
								<tr>
									<td>{{ $productDetails['name']}}</td>
								</tr>
								<tr>
									<td>{{ $productDetails['address']}}</td>
								</tr>
								<tr>
									<td>{{ $productDetails['city']}}</td>
								</tr>
								<tr>
									<td>{{ $productDetails['state']}}</td>
								</tr>
								<tr>
									<td>{{ $productDetails['country']}}</td>
								</tr>
								<tr>
									<td>{{ $productDetails['pincode']}}</td>
								</tr>
								<tr>
									<td>{{ $productDetails['mobile']}}</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>For any enquiries, you can contact us at <a href="info@online-shopping.com">info@online-shopping.com</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Regards,<br>Online Shopping</td></tr>
	</table>
</body>
</html>