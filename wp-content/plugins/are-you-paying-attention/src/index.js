import "./index.scss";
// wordpress handles loading it. we do not need install this from npm
// the wordpress automated solution that we are using from wordpress scripts
// is going to see this (@wordpress/components) and know that it can find it within the global scope of wordpress
// TextControl is wordpress element.
// for the @wordpress/components dependency add wp-editor to the dependency array in index.php
import {
  TextControl,
  Flex,
  FlexBlock,
  FlexItem,
  Button,
  Icon,
  PanelBody,
  PanelRow,
  ColorPicker
} from "@wordpress/components";
// webpack configuration that our automated javascript package is using looks for this library in the browser global scope.
import {InspectorControls, BlockControls, AlignmentToolbar} from "@wordpress/block-editor";
import {ChromePicker} from "react-color";
(function() {
    let locked = false;
    // wordpress will call the function each and everytime whenever any of the data in the block editor as a whole changes
    wp.data.subscribe(function() {
        const results = wp.data.select("core/block-editor").getBlocks().filter(function(block) {
            return block.name == "ourplugin/are-you-paying-attention" && block.attributes.correctAnswer == undefined
        });
        if(results.length && locked == false) {
            locked = true;
            // first argument: make a name for this criteria (noanswer)
            wp.data.dispatch("core/editor").lockPostSaving("noanswer")
        }
        if(!results.length && locked) {
            locked = false;
            wp.data.dispatch("core/editor").unlockPostSaving("noanswer")
        }
    });
})();

// Wordpress itself adds something called wp to the browsers global scope.
// inside that object, there is something called blocks
// and inside that there is something called registerBlockType.
// we want to make sure that wp-blocks dependency is loaded,
// before javascript loads are javascript file.
// registerBlockType() is from the wp-blocks package.
wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
  title: "Are You Paying Attention?",
  icon: "smiley",
  category: "common",
  attributes: {
    question: { type: "string", default: "" },
    answers: { type: "array" , default: [""]},
    correctAnswer: {type: "number", default: undefined},
    bgColor: {type: "string", default: "#EBEBEB"},
    theAlignment: {type: "string", default: "left"}
  },
  description: "Give your audience a chance to prove their comprehension. ",
  // example is used for block preview
  example: {
    attributes: {
        question: "What is my name?",
        answers: ["Meowsalot", "Barksalot", "Purrsloud", "Brad"],
        correctAnswer: 3,
        bgColor: "#CFE8F1",
        theAlignment: "center"
      }
  },
  // controls what we will see in the post editor screen
  edit: EditComponent,
  // controls what the actual public will see in our content
  // for transfering the responsiblity of output to php instead of javascript
  // return null for the save function
  save: function (props) {
    // wordpress is going to take whatever our save method returns and gets added to the database
    return null;
  },
});
function EditComponent(props) {
  function updateQuestion(value) {
    props.setAttributes({ question: value });
  }
  function deleteAnswer(indexToDelete) {
    const newAnswers = props.attributes.answers.filter(function(x, index) {
        return index != indexToDelete;
    });
    props.setAttributes({answers: newAnswers});
    if(indexToDelete == props.attributes.correctAnswer) {
        props.setAttributes({correctAnswer: undefined});
    }
  }
  function markAsCorrect(index) {
    props.setAttributes({correctAnswer: index})
  }
  return (
    // for the input values, get them from database using props
    // FlexBlock takes as much space as it can
    // FlexItem takes the small space that it can need
    // TextControl is a wordpress component
    <div className="paying-attention-edit-block" style={{backgroundColor: props.attributes.bgColor}}>
        <BlockControls>
            <AlignmentToolbar value={props.attributes.theAlignment} onChange={x => props.setAttributes({theAlignment: x})}/>
        </BlockControls>
       <InspectorControls>
        <PanelBody title="Background Color" initialOpen={true}>
          <PanelRow>
            <ChromePicker color={props.attributes.bgColor} onChangeComplete={x => props.setAttributes({bgColor: x.hex})} disableAlpha={true}/>
          </PanelRow>
        </PanelBody>
      </InspectorControls> 
      <TextControl
        label="Question:"
        value={props.attributes.question}
        onChange={updateQuestion}
        style={{ fontSize: "20px" }}
      />
      <p style={{ fontSize: "13px", margin: "20px 0 8px 0" }}>Answers:</p>
      {props.attributes.answers.map(function(answer, index) {
        return(
            <Flex key={index}>
            <FlexBlock>
              <TextControl  autoFocus={answer == ""} value={answer} onChange={newValue => {
                // concat method creates a new copy of the array
                const newAnswers = props.attributes.answers.concat([]);
                newAnswers[index] = newValue;
                props.setAttributes({answers: newAnswers});
              }}/>
            </FlexBlock>
    
            <FlexItem>
              <Button onClick={() => markAsCorrect(index)}>
                <Icon className="mark-as-correct" icon={props.attributes.correctAnswer == index ? "star-filled" : "star-empty"} />
              </Button>
            </FlexItem>
            <FlexItem>
              <Button isLink className="attention-delete" onClick={() => deleteAnswer(index)}>
                Delete
              </Button>
            </FlexItem>
          </Flex>
        )
      })}
      <Button isPrimary onClick={() => {
        // Make a copy of the answers array and concatenate
        props.setAttributes({answers: props.attributes.answers.concat([""])});
      }}>Add another answer</Button>
    </div>
  );
}
