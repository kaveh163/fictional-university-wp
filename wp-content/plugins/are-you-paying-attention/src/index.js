// Wordpress itself adds something called wp to the browsers global scope.
// inside that object, there is something called blocks
// and inside that there is something called registerBlockType.
// we want to make sure that wp-blocks dependency is loaded,
// before javascript loads are javascript file.
// registerBlockType() is from the wp-blocks package.
wp.blocks.registerBlockType('ourplugin/are-you-paying-attention', {
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        skyColor: {type: "string"},
        grassColor: {type: "string"}
    },
    // controls what we will see in the post editor screen
    edit: function(props) {
        function updateSkyColor(event) {
            // setAttributes is wordpress function
            props.setAttributes({skyColor: event.target.value});
        }
        function updateGrassColor(event) {
            props.setAttributes({grassColor: event.target.value});
        }
       
        return (
            // for the input values, get them from database using props
            <div>
                <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor}/>
                <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor}/>
            </div>
        )
    },
    // controls what the actual public will see in our content
    // for transfering the responsiblity of output to php instead of javascript
    // return null for the save function
    save: function(props) {
        // wordpress is going to take whatever our save method returns and gets added to the database
        return null;
    }
});