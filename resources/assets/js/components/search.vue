<template>
	<div class="input-group">
		<input type="search" class="form-control" v-model="query"
		placeholder="Type in to begin searching">
		<div class="input-group-addon"><i class="fa fa-search"></i></div>
	</div>
</template>
<script>
	import Fuse from "fuse.js"
	export default
	{

		props:{
			data:{
				required:true,
				type:Array
			},
			keys:{
				type:Array,
				required:true,
			},
			id:{
				default:null
			}
		},
		data()
		{
			return {
				query:''

			}

		},
		computed:{
			fuse()
			{
				return new Fuse(this.data,this.options);
			},

			options()
			{
				return{
					keys:this.keys,
					shouldSort: true,
					tokenize: true,
					minMatchCharLength:2
				};

			}
		},
		watch:{
			query(query)
			{
				let results=this.fuse.search(query);
				if (!query) {
					results=this.data;
				}
				this.$emit("searched",results);
			}
		}
	}
</script>