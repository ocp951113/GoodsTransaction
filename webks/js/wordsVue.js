var myuserId = $("#userId").val();
new Vue({
	el:"#main",
	data:{
		words:[],
		userId:myuserId
	},
	mounted:function(){
		jQuery.ajax({
			type:'POST',
			data:{
				"userId":this.userId
			},
			url:'../php/wordsFindByUserId.php',
			success:function(data){
				this.words = JSON.parse(data);
			}.bind(this)
		});
	},
	methods:{
		getMyWords:function(){
			jQuery.ajax({
				type:'POST',
				data:{
					"userId":this.userId
				},
				url:'../php/wordsFindByUserId.php',
				success:function(data){
					this.words = JSON.parse(data);
				}.bind(this)
			});
		},
		getOtherWords:function(){
			jQuery.ajax({
				type:'POST',
				data:{
					"userId":this.userId
				},
				url:'../php/wordsFindByUserId.php',
				success:function(data){
					alert(data)
//					this.words = JSON.parse(data);
				}.bind(this)
			});
		}
	}
})
