import "./index.scss"
import {useSelect} from "@wordpress/data"
import {useState, useEffect} from "react"
import apiFetch from "@wordpress/api-fetch"
const __ = wp.i18n.__;

wp.blocks.registerBlockType("ourplugin/featured-professor", {
  title: "Professor Callout",
  description: "Include a short description and link to a professor of your choice",
  icon: "welcome-learn-more",
  category: "common",
  attributes: {
    profId: {type: "string"}
  },
  edit: EditComponent,
  save: function () {
    return null
  }
})

function EditComponent(props) {
  const [thePreview, setThePreview] = useState("")

  useEffect(() => {
    if (props.attributes.profId) {
      updateTheMeta()
      async function go() {
        const response = await apiFetch({
          path: `/featuredProfessor/v1/getHTML?profId=${props.attributes.profId}`,
          method: "GET"
        })
        setThePreview(response)
      }
      go()
    }
  }, [props.attributes.profId])

  useEffect(() => {
    return () => {
      updateTheMeta();
    }
  }, [])
  
  function updateTheMeta() {
    let profIDsForMeta = wp.data
      .select("core/block-editor")
      .getBlocks()
      .filter((x) => x.name == "ourplugin/featured-professor")
      .map((x) => x.attributes.profId);

    profIDsForMeta = [...new Set(profIDsForMeta)]; //remove duplicates
    profIDsForMeta = profIDsForMeta.filter((x => x != undefined ));
    console.log(profIDsForMeta);
    wp.data
      .dispatch("core/editor")
      // the featuredprofessor meta key should be registered first using register_meta() function
      // editPost: Returns an action object used in signalling that attributes of the post have been edited.
      .editPost({ meta: { featuredprofessor: profIDsForMeta } });
  }

  const allProfs = useSelect(select => {
    return select("core").getEntityRecords("postType", "professor", {per_page: -1})
  })
  // useSelect is an asynchronous function
  //getEntityRecords first returns null when value is not recieved, then returns the value when recieved.
  console.log(allProfs)

  if (allProfs == undefined) return <p>Loading...</p>

  return (
    <div className="featured-professor-wrapper">
      <div className="professor-select-container">
        <select onChange={e => props.setAttributes({profId: e.target.value})} defaultValue={props.attributes.profId}>
          <option value="">{__("Select a professor", "featured-professor")}</option>
          {allProfs.map((prof, index) => {
            return (
              <option key={index} value={prof.id}>
                {prof.title.rendered}
              </option>
            )
          })}
        </select>
      </div>
      <div dangerouslySetInnerHTML={{__html: thePreview}}></div>
    </div>
  )
}