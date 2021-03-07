import EventService from "../../../service/event/event.service";
import moment from 'moment';
import swal from 'sweetalert';

const eventService = new EventService();

export default {
    data: function () {
        return {
            data: {
                title: '',
            	date_from: '',
            	date_to:'',
            	has_many_event_details:[],
            },
            get_days:[],
            days: [],
            dates:{
            	from: '',
            	to: ''
            },
            title:'',
            date:moment().format("MMM YYYY")

        }
    },
    mounted() {
    	this.getListDays();
        this.getEvent();
        this.initialize();
    },
    methods:{
    	initialize: function() {
    		let startOfMonth = moment(moment().format('MM/DD/YYYY')).startOf("month");
        	let endOfMonth = moment().endOf("month");
        	this.getDays(startOfMonth,endOfMonth);
    	},
        getEvent: function() {
            eventService.list().then(response => {
                if(response.data.data != null){
                    this.data = response.data.data;
                    this.title = this.data.title;
                    this.getDays(moment(this.data.date_from),moment(this.data.date_to));
                    this.date = moment(this.data.date_from).format("MMM YYYY");
                    this.filterResponse();
                }
            });
        },
    	getListDays: function() {
    		eventService.getDayList().then(response => {
	        	this.days = response.data.data;
                this.days.forEach(function(value) {
                    value.day_id = value.id;
                }, this.days);
	        });
    	},
    	save: function() {
            this.data.has_many_event_details = this.filterDays();
    		eventService.store(this.data).then(response => {
                this.data = response.data.data;
                this.getEvent();
                swal({
                  title: "Successfully Added!",
                  icon: "success",
                });
	        }, fail => {
                let errors = fail.response.data.errors;
                Object.entries(errors).forEach(([key, value]) => {
                    swal({
                      title: value,
                      icon: "warning",
                      dangerMode: true,
                    });
                });
            });
    	},
    	updateDate: function(key) {
            this.dates.from = moment(this.data.date_from); 
    		this.dates.to = moment(this.data.date_to);
            this.date = moment(this.data.date_from).format("MMM YYYY");
        	this.getDays(this.dates.from, this.dates.to);
            // console.log(this.date);
    	},
    	getDays: function(start, end) {
    		if(start && end){
    			const dates = [];
    			let now = start.clone();
		        while (end.isSameOrAfter(now)) {
		            dates.push({
		            	name: moment(now.format()).format("ddd"),
		            	day: moment(now.format()).format("D"),
		            	full_date : now.format('MM/DD/YYYY'),
		            	status: false,
		            	});
		            now.add(1, 'days');
		        }
		        return this.get_days = dates;
    		}
    	},
    	filterDates: function() {
    		const filter_days = this.filterDays();
    		this.get_days.forEach(function(value) {
    			if(filter_days.some(day => day.name == value.name)) value.status = true;
    		}, this.get_days);
    	},
    	filterDays: function() {
    		return this.days.filter(day => day.value == true);
    	},
        filterResponse: function() {
            const event_details = this.data.has_many_event_details;
            this.days.forEach(function(value) {
                event_details.some(day => day.day_id == value.id) ? value.value = true : value.value = false;
            }, this.days);
            this.filterDates();
        }
    }
}