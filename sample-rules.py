def findDecision(obj): #obj[0]: part_names, obj[1]: lifetime, obj[2]: load_cap, obj[3]: load_act, obj[4]: temp_act
	# {"feature": "load_cap", "instances": 350, "metric_value": 0.9988, "depth": 1}
	if obj[2]>5:
		# {"feature": "lifetime", "instances": 348, "metric_value": 0.9985, "depth": 2}
		if obj[1]>2726191:
			# {"feature": "part_names", "instances": 347, "metric_value": 0.9983, "depth": 3}
			if obj[0] == 'digital_output':
				# {"feature": "temp_act", "instances": 16, "metric_value": 0.9887, "depth": 4}
				if obj[4]>34:
					# {"feature": "load_act", "instances": 15, "metric_value": 0.971, "depth": 5}
					if obj[3]<=66:
						return 'No'
					elif obj[3]>66:
						return 'No'
					else: return 'No'
				elif obj[4]<=34:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'interface_module':
				# {"feature": "temp_act", "instances": 15, "metric_value": 0.9183, "depth": 4}
				if obj[4]>31:
					# {"feature": "load_act", "instances": 14, "metric_value": 0.8631, "depth": 5}
					if obj[3]<=51:
						return 'Yes'
					elif obj[3]>51:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=31:
					return 'No'
				else: return 'No'
			elif obj[0] == 'single_motor_module':
				# {"feature": "temp_act", "instances": 14, "metric_value": 0.9403, "depth": 4}
				if obj[4]>66:
					# {"feature": "load_act", "instances": 9, "metric_value": 0.5033, "depth": 5}
					if obj[3]>15:
						return 'No'
					elif obj[3]<=15:
						return 'No'
					else: return 'No'
				elif obj[4]<=66:
					# {"feature": "load_act", "instances": 5, "metric_value": 0.7219, "depth": 5}
					if obj[3]>16:
						return 'Yes'
					elif obj[3]<=16:
						return 'Yes'
					else: return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'circuit_breaker_motor_protection':
				# {"feature": "load_act", "instances": 12, "metric_value": 1.0, "depth": 4}
				if obj[3]>29:
					# {"feature": "temp_act", "instances": 10, "metric_value": 0.971, "depth": 5}
					if obj[4]>40:
						return 'Yes'
					elif obj[4]<=40:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=29:
					return 'No'
				else: return 'No'
			elif obj[0] == 'power_supply':
				# {"feature": "temp_act", "instances": 12, "metric_value": 0.8113, "depth": 4}
				if obj[4]<=101:
					# {"feature": "load_act", "instances": 10, "metric_value": 0.469, "depth": 5}
					if obj[3]>32:
						return 'Yes'
					elif obj[3]<=32:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]>101:
					return 'No'
				else: return 'No'
			elif obj[0] == 'ac_servo_synchronous_motor':
				# {"feature": "temp_act", "instances": 11, "metric_value": 0.994, "depth": 4}
				if obj[4]<=101:
					# {"feature": "load_act", "instances": 9, "metric_value": 0.9183, "depth": 5}
					if obj[3]<=81:
						return 'Yes'
					elif obj[3]>81:
						return 'No'
					else: return 'No'
				elif obj[4]>101:
					return 'No'
				else: return 'No'
			elif obj[0] == 'fan_motor':
				# {"feature": "load_act", "instances": 11, "metric_value": 0.994, "depth": 4}
				if obj[3]<=42:
					# {"feature": "temp_act", "instances": 9, "metric_value": 0.9911, "depth": 5}
					if obj[4]<=116:
						return 'No'
					elif obj[4]>116:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]>42:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'double_motor_module':
				# {"feature": "temp_act", "instances": 11, "metric_value": 0.8454, "depth": 4}
				if obj[4]>30:
					# {"feature": "load_act", "instances": 10, "metric_value": 0.7219, "depth": 5}
					if obj[3]>10:
						return 'Yes'
					elif obj[3]<=10:
						return 'No'
					else: return 'No'
				elif obj[4]<=30:
					return 'No'
				else: return 'No'
			elif obj[0] == 'analog_input':
				# {"feature": "temp_act", "instances": 11, "metric_value": 0.9457, "depth": 4}
				if obj[4]>49:
					# {"feature": "load_act", "instances": 9, "metric_value": 0.7642, "depth": 5}
					if obj[3]<=32:
						return 'No'
					elif obj[3]>32:
						return 'No'
					else: return 'No'
				elif obj[4]<=49:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'analog_output':
				# {"feature": "load_act", "instances": 11, "metric_value": 0.994, "depth": 4}
				if obj[3]>6:
					# {"feature": "temp_act", "instances": 9, "metric_value": 0.9911, "depth": 5}
					if obj[4]<=115:
						return 'Yes'
					elif obj[4]>115:
						return 'No'
					else: return 'No'
				elif obj[3]<=6:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'ac_induction_motor':
				# {"feature": "load_act", "instances": 11, "metric_value": 0.994, "depth": 4}
				if obj[3]<=34:
					# {"feature": "temp_act", "instances": 8, "metric_value": 0.9544, "depth": 5}
					if obj[4]>36:
						return 'No'
					elif obj[4]<=36:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]>34:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'relay_emergency_block':
				# {"feature": "load_act", "instances": 11, "metric_value": 0.9457, "depth": 4}
				if obj[3]>27:
					# {"feature": "temp_act", "instances": 6, "metric_value": 0.9183, "depth": 5}
					if obj[4]>46:
						return 'No'
					elif obj[4]<=46:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=27:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'limit_switch':
				# {"feature": "temp_act", "instances": 10, "metric_value": 1.0, "depth": 4}
				if obj[4]<=104:
					# {"feature": "load_act", "instances": 7, "metric_value": 0.8631, "depth": 5}
					if obj[3]>37:
						return 'No'
					elif obj[3]<=37:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]>104:
					return 'No'
				else: return 'No'
			elif obj[0] == 'encoder':
				# {"feature": "temp_act", "instances": 10, "metric_value": 1.0, "depth": 4}
				if obj[4]<=129:
					# {"feature": "load_act", "instances": 8, "metric_value": 0.9544, "depth": 5}
					if obj[3]<=38:
						return 'No'
					elif obj[3]>38:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]>129:
					return 'No'
				else: return 'No'
			elif obj[0] == 'sensor_angle':
				# {"feature": "temp_act", "instances": 10, "metric_value": 1.0, "depth": 4}
				if obj[4]<=108:
					# {"feature": "load_act", "instances": 8, "metric_value": 0.9544, "depth": 5}
					if obj[3]>4:
						return 'No'
					elif obj[3]<=4:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]>108:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'auxiliary_switch_block':
				# {"feature": "load_act", "instances": 10, "metric_value": 0.971, "depth": 4}
				if obj[3]<=31:
					# {"feature": "temp_act", "instances": 7, "metric_value": 0.5917, "depth": 5}
					if obj[4]<=83:
						return 'No'
					elif obj[4]>83:
						return 'No'
					else: return 'No'
				elif obj[3]>31:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'line_reactor':
				# {"feature": "load_act", "instances": 10, "metric_value": 0.8813, "depth": 4}
				if obj[3]>2:
					# {"feature": "temp_act", "instances": 9, "metric_value": 0.7642, "depth": 5}
					if obj[4]>40:
						return 'Yes'
					elif obj[4]<=40:
						return 'No'
					else: return 'No'
				elif obj[3]<=2:
					return 'No'
				else: return 'No'
			elif obj[0] == 'switch_disconnector':
				# {"feature": "load_act", "instances": 9, "metric_value": 0.9183, "depth": 4}
				if obj[3]>7:
					# {"feature": "temp_act", "instances": 7, "metric_value": 0.5917, "depth": 5}
					if obj[4]<=105:
						return 'Yes'
					elif obj[4]>105:
						return 'No'
					else: return 'No'
				elif obj[3]<=7:
					return 'No'
				else: return 'No'
			elif obj[0] == 'contactor':
				# {"feature": "temp_act", "instances": 9, "metric_value": 0.9911, "depth": 4}
				if obj[4]<=80:
					# {"feature": "load_act", "instances": 6, "metric_value": 0.65, "depth": 5}
					if obj[3]<=41:
						return 'Yes'
					elif obj[3]>41:
						return 'No'
					else: return 'No'
				elif obj[4]>80:
					return 'No'
				else: return 'No'
			elif obj[0] == 'bus_transmitter':
				# {"feature": "temp_act", "instances": 8, "metric_value": 1.0, "depth": 4}
				if obj[4]>75:
					# {"feature": "load_act", "instances": 6, "metric_value": 0.9183, "depth": 5}
					if obj[3]<=31:
						return 'No'
					elif obj[3]>31:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=75:
					return 'No'
				else: return 'No'
			elif obj[0] == 'nh_fuse':
				# {"feature": "load_act", "instances": 8, "metric_value": 1.0, "depth": 4}
				if obj[3]>5:
					# {"feature": "temp_act", "instances": 7, "metric_value": 0.9852, "depth": 5}
					if obj[4]<=67:
						return 'No'
					elif obj[4]>67:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=5:
					return 'No'
				else: return 'No'
			elif obj[0] == 'transformator':
				# {"feature": "temp_act", "instances": 8, "metric_value": 0.9544, "depth": 4}
				if obj[4]>76:
					return 'No'
				elif obj[4]<=76:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'proximity_sensor':
				# {"feature": "temp_act", "instances": 8, "metric_value": 0.9544, "depth": 4}
				if obj[4]<=124:
					# {"feature": "load_act", "instances": 7, "metric_value": 0.8631, "depth": 5}
					if obj[3]>13:
						return 'Yes'
					elif obj[3]<=13:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]>124:
					return 'No'
				else: return 'No'
			elif obj[0] == 'selenoid_valve':
				# {"feature": "load_act", "instances": 8, "metric_value": 0.9544, "depth": 4}
				if obj[3]>12:
					# {"feature": "temp_act", "instances": 7, "metric_value": 0.8631, "depth": 5}
					if obj[4]>36:
						return 'Yes'
					elif obj[4]<=36:
						return 'No'
					else: return 'No'
				elif obj[3]<=12:
					return 'No'
				else: return 'No'
			elif obj[0] == 'digital_input':
				# {"feature": "load_act", "instances": 8, "metric_value": 0.9544, "depth": 4}
				if obj[3]<=43:
					# {"feature": "temp_act", "instances": 6, "metric_value": 0.65, "depth": 5}
					if obj[4]<=68:
						return 'No'
					elif obj[4]>68:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]>43:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'repeater':
				# {"feature": "load_act", "instances": 7, "metric_value": 0.9852, "depth": 4}
				if obj[3]>16:
					return 'Yes'
				elif obj[3]<=16:
					return 'No'
				else: return 'No'
			elif obj[0] == 'fuse_holder':
				return 'Yes'
			elif obj[0] == 'gearbox':
				# {"feature": "temp_act", "instances": 7, "metric_value": 0.5917, "depth": 4}
				if obj[4]>41:
					return 'Yes'
				elif obj[4]<=41:
					return 'No'
				else: return 'No'
			elif obj[0] == 'air_conditioner_panel':
				# {"feature": "load_act", "instances": 6, "metric_value": 1.0, "depth": 4}
				if obj[3]>8:
					# {"feature": "temp_act", "instances": 4, "metric_value": 0.8113, "depth": 5}
					if obj[4]>62:
						return 'No'
					elif obj[4]<=62:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=8:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'control_unit':
				# {"feature": "temp_act", "instances": 6, "metric_value": 0.9183, "depth": 4}
				if obj[4]>32:
					# {"feature": "load_act", "instances": 5, "metric_value": 0.7219, "depth": 5}
					if obj[3]>32:
						return 'No'
					elif obj[3]<=32:
						return 'No'
					else: return 'No'
				elif obj[4]<=32:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'proportional_valve':
				# {"feature": "temp_act", "instances": 6, "metric_value": 0.65, "depth": 4}
				if obj[4]<=86:
					return 'No'
				elif obj[4]>86:
					# {"feature": "load_act", "instances": 2, "metric_value": 1.0, "depth": 5}
					if obj[3]>11:
						return 'Yes'
					elif obj[3]<=11:
						return 'No'
					else: return 'No'
				else: return 'Yes'
			elif obj[0] == 'active_interface_module':
				# {"feature": "temp_act", "instances": 6, "metric_value": 0.65, "depth": 4}
				if obj[4]>43:
					return 'No'
				elif obj[4]<=43:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'proximity_magnetic_sensor':
				# {"feature": "temp_act", "instances": 6, "metric_value": 0.9183, "depth": 4}
				if obj[4]<=74:
					return 'Yes'
				elif obj[4]>74:
					return 'No'
				else: return 'No'
			elif obj[0] == 'computer':
				# {"feature": "temp_act", "instances": 6, "metric_value": 1.0, "depth": 4}
				if obj[4]>79:
					# {"feature": "load_act", "instances": 4, "metric_value": 0.8113, "depth": 5}
					if obj[3]<=17:
						return 'No'
					elif obj[3]>17:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=79:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'emergency_switch':
				# {"feature": "temp_act", "instances": 5, "metric_value": 0.971, "depth": 4}
				if obj[4]>33:
					# {"feature": "load_act", "instances": 4, "metric_value": 0.8113, "depth": 5}
					if obj[3]>15:
						return 'Yes'
					elif obj[3]<=15:
						return 'No'
					else: return 'No'
				elif obj[4]<=33:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'active_line_module':
				# {"feature": "load_act", "instances": 5, "metric_value": 0.971, "depth": 4}
				if obj[3]>24:
					# {"feature": "temp_act", "instances": 4, "metric_value": 0.8113, "depth": 5}
					if obj[4]<=74:
						return 'Yes'
					elif obj[4]>74:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=24:
					return 'No'
				else: return 'No'
			elif obj[0] == 'control_module_profibus':
				# {"feature": "temp_act", "instances": 4, "metric_value": 0.8113, "depth": 4}
				if obj[4]<=64:
					return 'No'
				elif obj[4]>64:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'sensor_reflex':
				# {"feature": "load_act", "instances": 4, "metric_value": 0.8113, "depth": 4}
				if obj[3]>10:
					return 'No'
				elif obj[3]<=10:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'output_interface':
				# {"feature": "load_act", "instances": 4, "metric_value": 0.8113, "depth": 4}
				if obj[3]<=47:
					return 'No'
				elif obj[3]>47:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'sensor_module_cabinet':
				# {"feature": "load_act", "instances": 3, "metric_value": 0.9183, "depth": 4}
				if obj[3]<=33:
					return 'No'
				elif obj[3]>33:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'mcb_1_phase':
				# {"feature": "load_act", "instances": 3, "metric_value": 0.9183, "depth": 4}
				if obj[3]<=20:
					return 'No'
				elif obj[3]>20:
					return 'Yes'
				else: return 'Yes'
			else: return 'No'
		elif obj[1]<=2726191:
			return 'No'
		else: return 'No'
	elif obj[2]<=5:
		return 'No'
	else: return 'No'
