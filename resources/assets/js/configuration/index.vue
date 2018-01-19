<template>
	<div>
		<card >
		<div class="d-flex justify-content-between align-items-center box">

					<i class=" fa fa-cogs fa-3x text-primary "></i>
					
					<h2  class="text-info">Every thing can be configured from this page</h2>
					<i class=" fa fa-cog fa-3x text-primary"></i>



		</div>
			
		</card>
		<parking></parking>

		<other-income></other-income>
	
	</div>
</template>

<script>
import parking from "./parking";
import OtherIncome from "./otherIncome";

	export default
	{
		components:{parking,OtherIncome},
		
		props:[],

		data(){
			return {
			
			}
		}
	}
</script>
