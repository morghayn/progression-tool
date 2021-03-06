/**
 * Processes an approval selection request for an inactive project.
 *
 * @param projectID the ID of the inactive project.
 * @param approvalID the ID of the approval selection made.
 * @param count the current position of the project on the project board. Used for the alternating design.
 */
function approvalSelect(projectID, approvalID, count)
{
    let token = jQuery("#token").attr("name")

    jQuery.ajax(
        {
            data: {[token]: "1", task: "projectboard.approvalSelect", format: "json", projectID: projectID, approvalID: approvalID},
            success: (result) =>
            {
                if (result.data === true)
                {
                    document.getElementById(projectID).outerHTML = getProjectTemplate(projectID, count)
                }
            },
            error: () => console.log('Failure to perform affirm(). Contact an dashboard if this failure persists.'),
        }
    )
}

/**
 * If project has been approved, this function will be called by approvalSelection.
 * This function will request the server to generate the HTML to display the newly approved project as an approved project.
 * The AJAX will receive this HTML and replace the old inactive project template with the active project template.
 *
 * @param projectID the ID of the approved project.
 * @param count the current position of the project on the project board. Used for the alternating design.
 */
function getProjectTemplate(projectID, count)
{
    let token = jQuery("#token").attr("name")
    let html = ''

    jQuery.ajax(
        {
            data: {[token]: "1", task: "getProjectTemplate", format: "raw", projectID: projectID, count: count},
            async: false,
            success: (result) => html = result,
            error: () => html = '<h2>Failure to perform activateProject(). Contact an administrator if this failure persists.</h2>'
        }
    )

    return html
}

/**
 * Adjusts style to accommodate the absence of project selector.
 */
function accommodateNoSelector()
{
    document.getElementById('titleContainer').style.height = '4rem'
    document.getElementById('create').style.height = '100%'
    document.getElementById('title').style.height = '100%'
}

/**
 * Attaches event listeners to title container.
 */
function attachEventListeners()
{
    // Project create button event
    const create = document.getElementById('create')
    create.addEventListener('click', () =>
        window.location = '?option=com_progresstool&view=create'
    )

    // Timeline plot redirection
    const timelinePlot = document.getElementById('timelinePlot')
    timelinePlot.addEventListener('click', () =>
        window.open('?option=com_progresstool&view=timelineplot','mywindow').focus()
    )

    // Project selection event
    let projectSelect = document.getElementById('projectSelect')
    projectSelect.addEventListener("change", () => selectProject(projectSelect)
    )
}

/**
 * Title container project selection.
 *
 * @param projectSelect
 */
function selectProject(projectSelect)
{
    let projectID = projectSelect.options[projectSelect.selectedIndex].value
    if (projectID > 0)
    {
        // Display selected project
        let projects = document.getElementById('projects')
        let projectViewer = document.getElementById('projectViewer')
        projectViewer.style.display = "block"
        projects.style.display = "none"
        projectViewer.innerHTML = getProjectTemplate(projectID, 1)
    }
    else
    {
        // Display all projects
        window.location = '?option=com_progresstool&view=projectboard'
    }
}