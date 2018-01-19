<template>
	<VueForm action="/employees"  :fields="fields" @submitted="doneSubmitting">

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
			doneSubmitting(employee)
			{
				flash("employee was created successfully");

				this.$emit("employee:created",employee);
			}
		}
	}
</script>