<template>
	<tr>
		<td>
			{{detail.transaction.date}}
		</td>
		<td>
			{{detail.transaction.type}}
		</td>
		<td>
			{{detail.opening|currency}} 
			<span class="small">{{untiName}}</span>
		</td>
		<td> 
			<span class="small">Sold </span>
			{{detail.new|currency}} 
			<span class="small">{{unitName}}</span>
		</td>
		<td>
			{{detail.closing|currency}}
			<span class="small"> {{unitName}}</span>
		</td>
		<td>
			<span class="small">Bought @</span> 
			{{detail.currentPrice|currency}}
		</td>
		<td>
			<span class="small">Sold @</span>
			{{detail.transactedAt|currency}}
		</td>
	</tr>
</template>

<script>
	export default
	{
		props:["detail","unitName"],
	}
</script>
