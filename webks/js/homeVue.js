new Vue({
	el:"#main",
	data:{
		products:[],
		page:1,
		userName:""
	},
	created:function(){
		jQuery.ajax({
			type:'POST',
			url:'../php/homeFindGoods.php',
			success:function(data){
				this.products = JSON.parse(data);
			}.bind(this)
		})
	},
	methods:{
		getProducts:function(currPage){
			jQuery.ajax({
				type:'POST',
				data:{
					"page":this.page
				},
				url:'../php/homeFindGoods.php',
				success:function(data){
					this.products = JSON.parse(data);
				}.bind(this)
			})
		},
		sortASC:function(){
			jQuery.ajax({
				type:'POST',
				data:{
					"sortType":"ASC"
				},
				url:'../php/findcategoty.php',
				success:function(data){
					this.products = JSON.parse(data);
				}.bind(this)
			})
		},
		sortDESC:function(){
			jQuery.ajax({
				type:'POST',
				data:{
					"sortType":"DESC"
				},
				url:'../php/findcategoty.php',
				success:function(data){
					this.products = JSON.parse(data);
				}.bind(this)
			})
		}
	}

})