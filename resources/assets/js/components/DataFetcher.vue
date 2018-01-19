<template>
	<div>
		<zoom>
		<div class="card " v-if="error">
			<div class="card-block">
				<div class="alert alert-danger text-center ">
					<strong v-text="error"></strong>
				</div>
			</div>
		</div>
		</zoom>
	</div>
</template>	

<script>
	export default
	{
		props:{
			endPoint:{
				type:String,
				required:true
			}
		},

		data()
		{
			return {
				error:null,
			}
		},

		mounted()
		{
			this.fetchData()
			
		},
		methods:{
			fetchData()
			{
				this.error=null;
				axios.get(this.endPoint)
				.then(({data})=>{
					this.$emit("fetched",data);
				});

			}

		}
		
	}
</script>