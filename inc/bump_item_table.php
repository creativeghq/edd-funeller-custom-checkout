<?php
 if ($bump!=''):
 	?>
<?php 
	$cart = edd_get_cart_contents(); 
	$data = get_post($bump);
	$exists = false;
	foreach($cart as $cart_item) {
		if ($cart_item['id'] == $data->ID) {
			$exists = true;
			break;
		}
	}
	$edd_prices = edd_get_variable_prices($data->ID);
	// $edd_price = edd_price( $data->ID, false );
	if ($exists == false):	
	?>
	<div class="edd-funnel-bump-item" style="margin-top:20px;">
		<strong>You may also like to buy. Please check the below item to add to cart</strong>
	</div>
	<table>
		<tbody>
			<?php if ($edd_prices): ?>	
			<tr>
				<td>
					<select class="edd-funneler-product-<?php echo $id;?>" >
						<?php foreach($edd_prices as $id=>$price): ?>	
						<option value="<?php echo $id; ?>"><?php echo $price['name']; ?></option>
						<?php endforeach; ?>	
					</select>
				</td>
				<td><input type="text" name="edd-funnels-add-quantity" value="1" class="edd-funneler-quantity-<?php echo $id;?>"></td>
				<td class="edd-funnels-add-price-<?php echo $id; ?>"><?php echo $price['amount']; ?></td>
				<td><a href="javacript:void(0);" class="edd-funnels-add-to-cart" onclick="addToCartFunneler(jQuery('.edd-funneler-product-<?php echo $id;?>').val(), jQuery('.edd-funneler-quantity-<?php echo $id;?>').val())">Add to cart</a>
				</td>
			</tr>
			
			<?php else: ?>
			<?php $edd_price = edd_price( $data->ID, false ); 
			?>	
			<tr>
				<td><?php echo $data->post_title; ?></td>
				<td><input type="text" name="edd-funnels-add-quantity" class="edd-funneler-quantity-<?php echo $data->ID;?>" value="1"></td>
				<td><?php echo $edd_price; ?></td>
				<td><a href="javacript:void(0);" class="edd-funnels-add-to-cart" onclick="addToCartFunneler(data->ID, jQuery('.edd-funneler-quantity-<?php echo $data->ID;?>').val())">Add to cart</a></td>
			</tr>	
			<?php endif; ?>		
		</tbody>
	</table>
	<?php endif; ?>
<?php endif;?>