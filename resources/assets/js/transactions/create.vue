<template>
	<BaseTransaction :type="type" :button-name="buttonName">
		
	</BaseTransaction>
	
</template>
<script>
	
	

	import BaseTransaction from "./BaseTransaction";

	export default {
		props:["type"],
		
		components:{BaseTransaction},

		computed:{
			buttonName()
			{
				return this.type=="sale"?
				'Save and Make A sale':
				'Save and make a Purchase';
			}
		}
	
	}
</script>

