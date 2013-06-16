$(function() {
	function JQueryCourier() {
		this.get = function(base_url, id, lastUpdate, callback) {
			// console.log('get', base_url, id, lastUpdate, callback, arguments);
			var jqxhr = $.get(base_url.replace(':id', id), function(data) {
				// console.log("success", data, arguments);
			})
				.always(function(data, state) {
				// console.log("always", data, arguments);
				if (state == 'success') {
					callback(null, data);
				} else {
					callback(data, null);
				}
			});
		};
		this.send = function(base_url, id, message, callback) {

			var jqxhr = $.post(base_url.replace(':id', id), message, function() {}).always(function(data, state) {
				console.log("always", data, arguments);
				if (callback) {
					if (state == 'success') {
						callback(null, data);
					} else {
						callback(data, null);
					}
				}
			});
			console.log('send', arguments)
		};
		return this;
	}
	var messageCenter = new MessageCenter({
		courier: new JQueryCourier(),
		base_url: '#?:id'
	});
	var counter = 0;
	var counter2 = 0;

	messageCenter.suscribeToHub('1', function(hubId, data) {
		counter++;
		if (counter >= 20) {
			messageCenter.hubs[hubId].stopListening();
			console.log(hubId, "Counter reachead limit");
			messageCenter.hubs[hubId].send(this.base_url, hubId, "VAMOS PIBE!");
		} else {
			console.log(hubId, 'Counting', counter);
		}
	});
	messageCenter.suscribeToHub('2', function(hubId, data) {
		counter2++;
		if (counter2 >= 10) {
			messageCenter.hubs[hubId].stopListening();
			console.log(hubId, "Counter reachead limit");
			messageCenter.hubs[hubId].send(this.base_url, hubId, "VAMOS PIBE!");
		} else {
			console.log(hubId, 'Counting', counter2);
		}
	})
});