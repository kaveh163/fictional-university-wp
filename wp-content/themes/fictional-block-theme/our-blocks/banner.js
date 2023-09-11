import apiFetch from "@wordpress/api-fetch";
import { Button, PanelBody, PanelRow } from "@wordpress/components";
// name of the our-blocks directory could be anything
// instead of wp.blockEditor.InnerBlocks use below for wordpress scripts package
// The InnerBlocks component lets us to click on the plus symbol in the block editor
// to start adding new blocks inside our block
// To restrict the blocks we can add to our block, use allowedBlocks prop in InnerBlock Component
import {
  InnerBlocks,
  useBlockProps,
  useInnerBlocksProps,
  useSetting,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
} from "@wordpress/block-editor";
import {useEffect} from "@wordpress/element"
// first argument: namespace for all our blocks, and name for our specific block

wp.blocks.registerBlockType("ourblocktheme/banner", {
  apiVersion: 2,
  title: "Banner",
  attributes: {
    align: {
      type: "string",
      default: "full",
    },
    imgID: {type: "number"},
    imgURL : {type: "string", default: banner.fallbackimage}
  },

  supports: {
    align: ["full"],
    __experimentalLayout: {
      allowSwitching: false,
      default: {
        inherit: true,
      },
    },
  },
  edit: EditComponent,
  save: SaveComponent,
});

function EditComponent(props) {
  const blockProps = useBlockProps({ className: "page-banner" });
  const defaultLayout = useSetting("layout") || {};
  
  useEffect(function() {
    if(props.attributes.imgID) {
      async function go() {
        const response = await apiFetch({
          path: `/wp/v2/media/${props.attributes.imgID}`,
          method: 'GET'
        });
        props.setAttributes({imgURL : response.media_details.sizes.pageBanner.source_url})
      }
      go();
    }
  }, [props.attributes.imgID])

  function onFileSelect(x) {
    console.log(x);
    props.setAttributes({imgID: x.id});
  }
  return (
    <>
      <InspectorControls>
        <PanelBody title="Background" initialOpen={true}>
          <PanelRow>
            <MediaUploadCheck>
              <MediaUpload onSelect={onFileSelect} value={props.attributes.imgID} render={({open}) => {
                return <Button onClick={open}>Choose Image</Button>
              }}/>
            </MediaUploadCheck>
          </PanelRow>
        </PanelBody>
      </InspectorControls>
      <div {...blockProps}>
        <div
          className="page-banner__bg-image"
          style={{
            backgroundImage:
              `url('${props.attributes.imgURL}')`,
          }}
        ></div>
        <div className="page-banner__content container t-center c-white">
          <InnerBlocks
            allowedBlocks={[
              "ourblocktheme/genericheading",
              "ourblocktheme/genericbutton",
            ]}
            __experimentalLayout={defaultLayout}
          />
        </div>
      </div>
    </>
  );
}
// return content of SaveComponent will be saved in database
function SaveComponent() {
  // const blockProps = useBlockProps.save({ className: "page-banner" });
  // because the banner block can have blocks nested inside it, we do need to return this line below.
  return <InnerBlocks.Content />;
}
