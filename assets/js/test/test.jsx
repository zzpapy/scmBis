import {render, unmountComponentAtNode} from "react-dom"
import React, {useEffect} from "react"
import { usePaginatedFetch, useFetch } from './hooks'

function Test () {
    const {items : scms,setItems: setComments, load,loading,setCount, count,hasMore} = usePaginatedFetch('/api/scms')
    useEffect(() =>{
        load()
        
    },[])
    console.log(scms)
    return <div>salut</div>
}

class TestElement extends HTMLElement{

    connectedCallback(){
       render( <Test />, this)
    }

    disconnectedCallBack (){
        unmountComponentAtNode(this)
    }
}

customElements.define('test-test',TestElement)