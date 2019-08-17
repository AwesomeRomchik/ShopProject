function removeItemFromCart(name) {
	for (var i in cart){
		if (cart[i].name ===name) {
			cart[i].count --;
			if (cart[i].count === 0){
				cart.splice(i, 1);
			}
			break;
		}
	}
	saveCart();
}