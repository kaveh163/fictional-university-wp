import { ToolbarGroup, ToolbarButton } from "@wordpress/components";
import {
  RichText,
  BlockControls,
  useBlockProps,
  AlignmentToolbar,
  BlockAlignmentToolbar,
} from "@wordpress/block-editor";
import { registerBlockType } from "@wordpress/blocks";
// first argument: namespace for all our blocks, and name for our specific block
registerBlockType("ourblocktheme/genericheading", {
  apiVersion: 2,
  
  edit: EditComponent,
  save: SaveComponent,
});

function EditComponent(props) {
  const blockProps = useBlockProps();
  // providing an empty array to allowedFormats makes all of the options like bold or italic gone in the toolbar editor for the block.
  // for the isPressed value, we give it a value of true or false, so that decides whether the button should be selected or highlighted.
  function handleTextChange(x) {
    props.setAttributes({ text: x });
  }

  return (
    <div {...blockProps}>

      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton
            isPressed={props.attributes.size === "large"}
            onClick={() => props.setAttributes({ size: "large" })}
          >
            Large
          </ToolbarButton>
          <ToolbarButton
            isPressed={props.attributes.size === "medium"}
            onClick={() => props.setAttributes({ size: "medium" })}
          >
            Medium
          </ToolbarButton>
          <ToolbarButton
            isPressed={props.attributes.size === "small"}
            onClick={() => props.setAttributes({ size: "small" })}
          >
            Small
          </ToolbarButton>
        </ToolbarGroup>
      </BlockControls>
      <RichText
        allowedFormats={["core/bold", "core/italic"]}
        tagName="h1"
        className={`headline headline--${props.attributes.size}`}
        value={props.attributes.text}
        onChange={handleTextChange}
      />
    </div>
  );
}
// return content of SaveComponent will be saved in database
function SaveComponent(props) {
  const blockProps = useBlockProps.save({
    tagName: createTagName(),
    value: props.attributes.text,
    className: `headline headline--${props.attributes.size}`
  });
  function createTagName() {
    switch (props.attributes.size) {
      case "large":
        return "h1";
      case "medium":
        return "h2";
      case "small":
        return "h3";
    }
  }
  return (
    <RichText.Content
    { ...blockProps }
    />
  );
}
