import {render, unmountComponentAtNode} from "react-dom"
import React, {useEffect,useCallback} from "react"
import { usePaginatedFetch, useFetch } from './hooks'
import {Icon} from '../components/Icon'

const Toto = React.memo(({scm}) => {
    console.log(scm)
 return <p>{scm.nom}</p>
})

function Title({count}){
    return <h3>
        <Icon icon="comments" />
        {count} Commentaire{count > 1 ? 's': ''} </h3>
}

function Test () {
    const {items : scms,setItems: setComments, load,loading,setCount, count,hasMore} = usePaginatedFetch('/api/scms')
    useEffect(() =>{
        load()        
    },[])
    return <div>
        <Title count={count} />
        {console.log(count)}
        {loading && 'chargement...'}
        {scms.map((scm) => <Toto scm={scm} key={scm.id}/>)}
        
        </div>
    
}


class TestElement extends HTMLElement{
    
    connectedCallback(){
       render( <Test />, this)
    }

    // disconnectedCallBack (){
    //     unmountComponentAtNode(this)
    // }
}

customElements.define('test-test',TestElement)