def findDecision(obj): #obj[0]: part_names, obj[1]: lifetime, obj[2]: load_cap, obj[3]: load_act, obj[4]: temp_act
	# {"feature": "load_cap", "instances": 351, "metric_value": 0.9987, "depth": 1}
	if obj[2]>5:
		# {"feature": "lifetime", "instances": 350, "metric_value": 0.9985, "depth": 2}
		if obj[1]>76799:
			# {"feature": "part_names", "instances": 349, "metric_value": 0.9987, "depth": 3}
			if obj[0] == 'interface_module':
				# {"feature": "temp_act", "instances": 22, "metric_value": 0.994, "depth": 4}
				if obj[4]>36:
					# {"feature": "load_act", "instances": 18, "metric_value": 0.9911, "depth": 5}
					if obj[3]<=59:
						return 'Yes'
					elif obj[3]>59:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=36:
					return 'No'
				else: return 'No'
			elif obj[0] == 'sensor_module_cabinet':
				# {"feature": "load_act", "instances": 22, "metric_value": 0.9457, "depth": 4}
				if obj[3]>10:
					# {"feature": "temp_act", "instances": 20, "metric_value": 0.8813, "depth": 5}
					if obj[4]<=115:
						return 'Yes'
					elif obj[4]>115:
						return 'No'
					else: return 'No'
				elif obj[3]<=10:
					return 'No'
				else: return 'No'
			elif obj[0] == 'selenoid_valve':
				# {"feature": "temp_act", "instances": 19, "metric_value": 0.998, "depth": 4}
				if obj[4]>55:
					# {"feature": "load_act", "instances": 16, "metric_value": 0.9887, "depth": 5}
					if obj[3]>17:
						return 'No'
					elif obj[3]<=17:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=55:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'power_module':
				# {"feature": "load_act", "instances": 16, "metric_value": 0.9544, "depth": 4}
				if obj[3]<=50:
					# {"feature": "temp_act", "instances": 14, "metric_value": 0.8631, "depth": 5}
					if obj[4]<=88:
						return 'Yes'
					elif obj[4]>88:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]>50:
					return 'No'
				else: return 'No'
			elif obj[0] == 'switch_disconnector':
				# {"feature": "temp_act", "instances": 15, "metric_value": 0.9183, "depth": 4}
				if obj[4]>46:
					# {"feature": "load_act", "instances": 10, "metric_value": 1.0, "depth": 5}
					if obj[3]<=36:
						return 'Yes'
					elif obj[3]>36:
						return 'No'
					else: return 'No'
				elif obj[4]<=46:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'limit_switch':
				# {"feature": "temp_act", "instances": 14, "metric_value": 0.9403, "depth": 4}
				if obj[4]>40:
					# {"feature": "load_act", "instances": 12, "metric_value": 0.8113, "depth": 5}
					if obj[3]>19:
						return 'Yes'
					elif obj[3]<=19:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=40:
					return 'No'
				else: return 'No'
			elif obj[0] == 'encoder':
				# {"feature": "load_act", "instances": 14, "metric_value": 0.9852, "depth": 4}
				if obj[3]>2:
					# {"feature": "temp_act", "instances": 13, "metric_value": 0.9612, "depth": 5}
					if obj[4]<=149:
						return 'No'
					elif obj[4]>149:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=2:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'ac_induction_motor':
				# {"feature": "temp_act", "instances": 14, "metric_value": 0.8631, "depth": 4}
				if obj[4]>48:
					# {"feature": "load_act", "instances": 12, "metric_value": 0.65, "depth": 5}
					if obj[3]<=27:
						return 'No'
					elif obj[3]>27:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=48:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'fan_panel':
				# {"feature": "temp_act", "instances": 14, "metric_value": 0.9852, "depth": 4}
				if obj[4]<=119:
					# {"feature": "load_act", "instances": 10, "metric_value": 0.971, "depth": 5}
					if obj[3]<=43:
						return 'Yes'
					elif obj[3]>43:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]>119:
					return 'No'
				else: return 'No'
			elif obj[0] == 'fuse_holder':
				# {"feature": "temp_act", "instances": 13, "metric_value": 0.9612, "depth": 4}
				if obj[4]<=111:
					# {"feature": "load_act", "instances": 11, "metric_value": 0.8454, "depth": 5}
					if obj[3]>26:
						return 'No'
					elif obj[3]<=26:
						return 'No'
					else: return 'No'
				elif obj[4]>111:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'active_interface_module':
				# {"feature": "load_act", "instances": 13, "metric_value": 0.9612, "depth": 4}
				if obj[3]>7:
					# {"feature": "temp_act", "instances": 12, "metric_value": 0.9799, "depth": 5}
					if obj[4]>63:
						return 'No'
					elif obj[4]<=63:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=7:
					return 'No'
				else: return 'No'
			elif obj[0] == 'analog_input':
				# {"feature": "load_act", "instances": 13, "metric_value": 0.9957, "depth": 4}
				if obj[3]<=55:
					# {"feature": "temp_act", "instances": 10, "metric_value": 0.971, "depth": 5}
					if obj[4]>42:
						return 'No'
					elif obj[4]<=42:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]>55:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'plc':
				# {"feature": "load_act", "instances": 12, "metric_value": 1.0, "depth": 4}
				if obj[3]>22:
					# {"feature": "temp_act", "instances": 10, "metric_value": 0.971, "depth": 5}
					if obj[4]<=128:
						return 'No'
					elif obj[4]>128:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]<=22:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'supply_bus_controller':
				# {"feature": "temp_act", "instances": 12, "metric_value": 0.9799, "depth": 4}
				if obj[4]<=88:
					# {"feature": "load_act", "instances": 8, "metric_value": 0.5436, "depth": 5}
					if obj[3]>5:
						return 'Yes'
					elif obj[3]<=5:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]>88:
					return 'No'
				else: return 'No'
			elif obj[0] == 'circuit_breaker_motor_protection':
				# {"feature": "load_act", "instances": 11, "metric_value": 0.9457, "depth": 4}
				if obj[3]>1:
					# {"feature": "temp_act", "instances": 10, "metric_value": 0.8813, "depth": 5}
					if obj[4]>38:
						return 'Yes'
					elif obj[4]<=38:
						return 'No'
					else: return 'No'
				elif obj[3]<=1:
					return 'No'
				else: return 'No'
			elif obj[0] == 'profisafe_digital_output':
				# {"feature": "load_act", "instances": 11, "metric_value": 0.9457, "depth": 4}
				if obj[3]<=68:
					# {"feature": "temp_act", "instances": 10, "metric_value": 0.8813, "depth": 5}
					if obj[4]<=141:
						return 'No'
					elif obj[4]>141:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]>68:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'output_interface':
				# {"feature": "temp_act", "instances": 10, "metric_value": 0.7219, "depth": 4}
				if obj[4]>77:
					return 'Yes'
				elif obj[4]<=77:
					return 'No'
				else: return 'No'
			elif obj[0] == 'fan_motor':
				# {"feature": "load_act", "instances": 10, "metric_value": 0.8813, "depth": 4}
				if obj[3]<=59:
					# {"feature": "temp_act", "instances": 8, "metric_value": 0.5436, "depth": 5}
					if obj[4]<=107:
						return 'No'
					elif obj[4]>107:
						return 'No'
					else: return 'No'
				elif obj[3]>59:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'profisafe_digital_input':
				# {"feature": "temp_act", "instances": 10, "metric_value": 0.8813, "depth": 4}
				if obj[4]>36:
					# {"feature": "load_act", "instances": 9, "metric_value": 0.7642, "depth": 5}
					if obj[3]>15:
						return 'Yes'
					elif obj[3]<=15:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=36:
					return 'No'
				else: return 'No'
			elif obj[0] == 'mcb_1_phase':
				# {"feature": "temp_act", "instances": 9, "metric_value": 0.9911, "depth": 4}
				if obj[4]>42:
					# {"feature": "load_act", "instances": 7, "metric_value": 0.8631, "depth": 5}
					if obj[3]>27:
						return 'Yes'
					elif obj[3]<=27:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=42:
					return 'No'
				else: return 'No'
			elif obj[0] == 'ac_servo_synchronous_motor':
				# {"feature": "temp_act", "instances": 9, "metric_value": 0.9183, "depth": 4}
				if obj[4]<=114:
					# {"feature": "load_act", "instances": 7, "metric_value": 0.9852, "depth": 5}
					if obj[3]<=39:
						return 'Yes'
					elif obj[3]>39:
						return 'No'
					else: return 'No'
				elif obj[4]>114:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'power_supply':
				# {"feature": "temp_act", "instances": 9, "metric_value": 0.7642, "depth": 4}
				if obj[4]>36:
					# {"feature": "load_act", "instances": 8, "metric_value": 0.5436, "depth": 5}
					if obj[3]<=18:
						return 'No'
					elif obj[3]>18:
						return 'No'
					else: return 'No'
				elif obj[4]<=36:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'emergency_switch':
				# {"feature": "load_act", "instances": 9, "metric_value": 0.9183, "depth": 4}
				if obj[3]>7:
					# {"feature": "temp_act", "instances": 8, "metric_value": 0.8113, "depth": 5}
					if obj[4]>91:
						return 'No'
					elif obj[4]<=91:
						return 'No'
					else: return 'No'
				elif obj[3]<=7:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'air_conditioner_panel':
				# {"feature": "temp_act", "instances": 9, "metric_value": 0.9911, "depth": 4}
				if obj[4]>48:
					# {"feature": "load_act", "instances": 8, "metric_value": 0.9544, "depth": 5}
					if obj[3]<=42:
						return 'Yes'
					elif obj[3]>42:
						return 'No'
					else: return 'No'
				elif obj[4]<=48:
					return 'No'
				else: return 'No'
			elif obj[0] == 'bus_transmitter':
				# {"feature": "load_act", "instances": 8, "metric_value": 1.0, "depth": 4}
				if obj[3]<=47:
					# {"feature": "temp_act", "instances": 6, "metric_value": 0.9183, "depth": 5}
					if obj[4]>49:
						return 'No'
					elif obj[4]<=49:
						return 'Yes'
					else: return 'Yes'
				elif obj[3]>47:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'nh_fuse':
				# {"feature": "load_act", "instances": 8, "metric_value": 0.8113, "depth": 4}
				if obj[3]<=27:
					return 'Yes'
				elif obj[3]>27:
					# {"feature": "temp_act", "instances": 4, "metric_value": 1.0, "depth": 5}
					if obj[4]>62:
						return 'No'
					elif obj[4]<=62:
						return 'Yes'
					else: return 'Yes'
				else: return 'No'
			elif obj[0] == 'contactor':
				# {"feature": "temp_act", "instances": 7, "metric_value": 0.8631, "depth": 4}
				if obj[4]>64:
					# {"feature": "load_act", "instances": 4, "metric_value": 1.0, "depth": 5}
					if obj[3]>47:
						return 'No'
					elif obj[3]<=47:
						return 'Yes'
					else: return 'Yes'
				elif obj[4]<=64:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'analog_output':
				# {"feature": "temp_act", "instances": 6, "metric_value": 0.65, "depth": 4}
				if obj[4]>52:
					return 'Yes'
				elif obj[4]<=52:
					return 'No'
				else: return 'No'
			elif obj[0] == 'proportional_valve':
				# {"feature": "temp_act", "instances": 4, "metric_value": 1.0, "depth": 4}
				if obj[4]<=49:
					return 'Yes'
				elif obj[4]>49:
					return 'No'
				else: return 'No'
			elif obj[0] == 'proximity_magnetic_sensor':
				# {"feature": "load_act", "instances": 3, "metric_value": 0.9183, "depth": 4}
				if obj[3]>7:
					return 'No'
				elif obj[3]<=7:
					return 'Yes'
				else: return 'Yes'
			elif obj[0] == 'repeater':
				return 'No'
			else: return 'No'
		elif obj[1]<=76799:
			return 'Yes'
		else: return 'Yes'
	elif obj[2]<=5:
		return 'No'
	else: return 'No'
