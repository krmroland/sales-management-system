<template>
	<div class="modal is-active" v-if="show">
	  <div class="modal-background"></div>
	  <div class="modal-card animated zoomIn">
	    <header class="modal-card-head bg-primary text-white">
	      <p class="modal-card-title text-center">
	      	<slot name="header"></slot>
	      </p>
	      <button class="close" @click="$emit('closed');">
	      	<i class="fa fa-close text-white " ></i>
	      </button>
	    </header>
	    <section class="modal-card-body">
			<slot></slot>
	    </section>
	    <footer class="modal-card-foot">
	    	<slot name="footer"></slot>
	    </footer>
	  </div>
	</div>
</template>
<script>
	export default{

		props:["show"],

	}
</script>