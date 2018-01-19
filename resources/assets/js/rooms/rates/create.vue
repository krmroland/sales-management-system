<template>

		<VueForm :action="'/rooms/'+room.id+'/rates'" :fields="fields"
			@submitted="added">
		</VueForm>

</template>

<script>
	import VueForm from "../../forms/VueForm";
	import structure from "./structure";

	let fields=(new structure()).plain();
	export default
	{
		components:{VueForm},
		props:["room"],

		data(){
			return {
				fields

			}

		},
		methods:{
			added(room)
			{
				this.$emit('rate:added',room);
				flash("Rate was added successfully");
			}
		}
	}
</script>
