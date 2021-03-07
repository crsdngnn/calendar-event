<template>
	<div class="container mt-4 shadow p-3 mb-5 bg-body rounded">
		<h5>Calendar</h5>
		<hr>
		<div class="container">
			<div class="row">
			    <div class="col-lg-4">
			      <div>
			      	<label class="pb-2">Event Title</label>
			      	<input type="text" class="form-control" v-model="data.title" aria-describedby="emailHelp" placeholder="Enter event title">
			      </div>
			      <div class="row pt-2">
			      	<div class="col-sm-6">
			      		<label class="pb-2">From</label>
			      		<input type="date" class="form-control" v-model="data.date_from" @change="updateDate('from')">
			      	</div>
			      	<div class="col-sm-6">
			      		<label class="pb-2">To</label>
			      		<input type="date" class="form-control" v-model="data.date_to" @change="updateDate('to')">
			      	</div>
			      </div>
			      <div class="row pt-2">
			      	<div class="form-check">
					    <label class="checkbox-inline" v-for="(value, index) in days" style="margin:5px;">
					    	<input type="checkbox" v-model="value.value" :value="true" :checked="value.value == true">{{value.name}}
					    </label>
					</div>
			      </div>
			      <div>
			      	<button @click="save()" class="btn btn-primary">Save</button>
			      </div>
			    </div>
			    <div class="col-lg">
			      {{date}}
			      <hr>
			      <div class="container" v-for="(value, index) in get_days">
			      	<div class="row">
			      		<div class="col-sm-1">{{value.day}}</div>
			      		<div class="col-sm-2">{{value.name}}</div>
			      		<div class="col-sm-7" v-if="value.status">{{title}}</div>
			      	</div>
			      	<hr>
			      </div>
			    </div>
			 </div>
		</div>
	</div>
</template>
<script src="./calendar.js"></script>
