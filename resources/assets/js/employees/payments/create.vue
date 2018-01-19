<template>
	<div>
		<VueForm :action="'/employee/'+employee.id+'/payments'" :fields="fields" 
				@submitted="$emit('employee:paid',$event)" >
			
		</VueForm>
	</div>
</template>

<script>

	import VueForm from "../../forms/VueForm";
	
	export default
	{
		components:{VueForm},

		props:["employee"],

		data(){
			return {

				fields:[
				{
					name:"date",
					label:"Select A date Please",
					type:"date"
				},
				{
					name:"type",
					label:"The payment type",
					options:window.company.expenditure.employees.types
				},
				{
					name:"interval",
					label:"The payment interval",
					options:window.company.expenditure.employees.intervals
				},
				{
					name:"ammount",
					label:"The ammount being paid to "+this.employee.name,
					min:0
				},
				{
					name:"description",
					label:"A small Description to describe this payment",
				}
				]
			}
		}
	}
</script>
