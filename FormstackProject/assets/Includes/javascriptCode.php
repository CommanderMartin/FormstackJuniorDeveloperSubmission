<script>
		function ToggleWorkOption(number){
			var toggleAreas = [];
			
			for(var a = 1; a <= 5; a++)
			{
				toggleAreas.push(document.getElementById("workArea" + a));
			}
			
			for(var b = 0; b < 5; b++)
			{
				if(number - 1 == b)
				{
					if(toggleAreas[b] != null)
					{
						toggleAreas[b].style.display = "block";						
					}
				}
				else
				{
					if(toggleAreas[b] != null)
					{
						toggleAreas[b].style.display = "none";						
					}
				}
			}			
		}
</script>