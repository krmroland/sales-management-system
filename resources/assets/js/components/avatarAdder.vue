<template>
	<modal :show="isAddingAvatar" @closed="$emit('update:isAddingAvatar',false)">
		<h3 slot="header">Add A new Image</h3>
		<p class="font-italic">Please select to choose a photo</p>
		<form :action="endPoint" method="post" enctype="multipart/form-data" @submit.prevent="submitPhoto" ref="form">


			<div class="form-group">
				<label for="exampleInputFile">Dsrs Photo</label>
				<input type="file" class="form-control-file" name="avatar">
			</div>
			<p v-if="error" v-text="error+'    (Please Try Again!)'" class="form-text text-danger">
				
			</p>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-camera"></i>
					Save The Picture
				</button>
			</div>
		</form>
	</modal>
</template>

<script>
	export default
	{
		props:{
			model:{
				required:true,

			},
			id:{
				required:true
			},
			isAddingAvatar:{}
		},
		data()
		{
			return {
				error:false,
			}
		},
		computed:{
			endPoint()
			{
				return "/"+this.model+"/"+this.id+"/avatar";
			}
		},
		methods:{
			submitPhoto()
			{
				flash("Feature still in progress will be completed soon!","warning");
			}
		}
	}
</script>
