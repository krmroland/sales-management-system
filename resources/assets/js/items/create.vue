<template>
	<VueForm action="/items"  :fields="fields" @submitted="doneSubmitting">

	</VueForm>
</template>

<script>

	

	import VueForm from "../forms/VueForm";

	import structure from "./structure";

	export default
	{
		components:{VueForm},

		created()
		{

		},

		data()
		{
			return{
				fields: (new structure()).plain()
			}
		},
		methods:{
			doneSubmitting(data)
			{
				flash("Item was created successfully");
				events.$emit("item:created",data);
				this.$emit("item:created",data);
			}
		}
	}
</script>