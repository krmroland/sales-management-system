<template>
	<div class="card mt-2 " :class="extraClass">
		<div class="card-block">
			<div class="card-title text-center">
				<slot name="title"></slot>
			</div>
			<slot></slot>
		</div>
	</div>
</template>
<script>
	export default{
		props:["extraClass"]
	}
</script>