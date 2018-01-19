<template>
	<div class="box text-center">
		<switchery :options="['sales','summary']">
			
		</switchery>
	</div>
</template>
<script>

import switchery from "../switch/switchery";

	export default{
		components:{switchery},
	}
</script>