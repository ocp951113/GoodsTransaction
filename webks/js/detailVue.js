var myproductId = $("#productId").val();
var myuserId = $("#userId").val();
var myotheruserId = $("#otheruserId").val();
var interval;
new Vue({
	el:"#main",
	data:{
		words:[],
		productId:myproductId,
		content:'',
		userId:myuserId,
		otheruserId:myotheruserId,
		zishu:0
	},
	mounted:function(){
		jQuery.ajax({
			type:'POST',
			data:{
				"productId":this.productId
			},
			url:'../php/wordsFind.php',
			success:function(data){
				this.words = JSON.parse(data);
			}.bind(this)
		});
	},
	methods:{
		publishWords:function(){
			jQuery.ajax({
				type:'POST',
				data:{
					"productId":this.productId,
					"userId":this.userId,
					"content":this.content,
					"otheruserId":this.otheruserId
				},
				url:'../php/insertWords.php',
				success:function(data){
					this.words = JSON.parse(data);
					this.content='';
					alert("留言成功！！");
				}.bind(this)
			})	
		},
		mytime:function(){
			this.zishu = this.content.length;
		},
		updatezishu:function(){
			interval = setInterval(this.mytime(),10);
		},
		myclear:function(){
			clearInterval(interval);
		},
		collection:function(){
			jQuery.ajax({
				type:'POST',
				data:{
					"productId":this.productId,
					"userId":this.userId,
				},
				url:'../php/collection.php',
				success:function(data){
					alert(data);
				}.bind(this)
			})	
		},
		addShoppingCart:function(){
			jQuery.ajax({
				type:'POST',
				data:{
					"productId":this.productId,
					"userId":this.userId,
				},
				url:'../php/addShoppingCart.php',
				success:function(data){
					alert(data);
				}.bind(this)
			})	
		}
	}
})
