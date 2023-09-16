import ourColors from "../inc/ourColors"
// to import @wordpress/icons should use npm to install it
import { link } from "@wordpress/icons";
import {
  ToolbarGroup,
  ToolbarButton,
  Popover,
  Button,
  PanelBody,
  PanelRow,
  ColorPalette
} from "@wordpress/components";
// LinkControl is for link urls.
// InspectorControls for sidebar settings
import {
  RichText,
  BlockControls,
  useBlockProps,
  __experimentalLinkControl as LinkControl,
  InspectorControls,
  getColorObjectByColorValue
} from "@wordpress/block-editor";
import { registerBlockType } from "@wordpress/blocks";
// we import useState from react using @wordpress/element
import { useState } from "@wordpress/element";
// first argument: namespace for all our blocks, and name for our specific block
registerBlockType("ourblocktheme/genericbutton", {
  apiVersion: 2,
  title: "Generic Button",
  attributes: {
    text: {
      type: "string",
    },
    size: {
      type: "string",
      default: "large",
    },
    linkObject: {
      type: "object",
      default: {url: ""}
    },
    colorName: {
        type: "string",
        default: "blue"
    }
  },
  edit: EditComponent,
  save: SaveComponent,
});

function EditComponent(props) {
  // note that isLinkPickerVisible is for toggle so we don't save it in database(attributes)
  const [isLinkPickerVisible, setIsLinkPickerVisible] = useState(false);
  const blockProps = useBlockProps();
  // providing an empty array to allowedFormats makes all of the options like bold or italic gone in the toolbar editor for the block.
  // for the isPressed value, we give it a value of true or false, so that decides whether the button should be selected or highlighted.
  function handleTextChange(x) {
    props.setAttributes({ text: x });
  }
  function buttonHandler() {
    setIsLinkPickerVisible((prev) => !prev);
  }
  function handleLinkChange(newLink) {
    props.setAttributes({linkObject: newLink});
  }
  
  const currentColorValue = ourColors.filter((color) => {
    return color.name == props.attributes.colorName;
  })[0].color;
  function handleColorChange(colorCode) {
    // from the hex value that the color palette gives us, we need to find its color name
    const {name} = getColorObjectByColorValue(ourColors, colorCode)
    props.setAttributes({colorName: name});
  }
  return (
    <div {...blockProps}>
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton onClick={buttonHandler} icon={link} />
        </ToolbarGroup>
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
      <InspectorControls>
        <PanelBody title="Color" initialOpen={true}>
            <PanelRow>
                <ColorPalette disableCustomColors={true} clearable={false} colors={ourColors} value={currentColorValue} onChange={handleColorChange}/>
            </PanelRow>
        </PanelBody>
      </InspectorControls>
      <RichText
        allowedFormats={[]}
        tagName="a"
        className={`btn btn--${props.attributes.size} btn--${props.attributes.colorName}`}
        value={props.attributes.text}
        onChange={handleTextChange}
      />
      {isLinkPickerVisible && (
      <Popover position="middle center" onFocusOutside={() => setIsLinkPickerVisible(false)}>
        <LinkControl settings={[]} value={props.attributes.linkObject} onChange={handleLinkChange}/>
        <Button variant="primary" onClick={()=> setIsLinkPickerVisible(false)} style={{display: "block", width: "100%"}}>Confirm Link</Button>
      </Popover>
      )}
    </div>
  );
}
// return content of SaveComponent will be saved in database
// we don't need RichText.Content since we don't include nested element like strong or em (bold, and italics)
function SaveComponent(props) {
  const blockProps = useBlockProps.save({
    className: `btn btn--${props.attributes.size} btn--${props.attributes.colorName}`,
  });

  return (
    <a href={props.attributes.linkObject.url} {...blockProps}>
      {props.attributes.text}
    </a>
  );
}
