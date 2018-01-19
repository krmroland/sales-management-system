<template>
	<div>
		<create></create>
		<card>
			<vue-table end-point="/expenditures" title="Recently Made Expenitures"
			placeholder="Filter An Expenditure" :isClickable="false">
			<table-cell label="date" data-name="date"></table-cell>
			<table-cell label="type" data-name="type" filter="title"></table-cell>
			<table-cell label="Category" data-name="category" filter="title"></table-cell>

			<table-cell label="Ammount Paid" data-name="ammount" filter="currency"></table-cell>
			<table-cell label="Description" data-name="description" ></table-cell>

		</vue-table>
	</card>

</div>
</template>

<script>
	import create from "./create";

	export default
	{
		components:{create},
	}
</script>
