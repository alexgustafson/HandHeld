//
//  CMLocationItemView.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 19.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "CMLocationItemView.h"

@implementation CMLocationItemView
@synthesize button, view, field, dbManager,linkToArticleNr, locationIcon, xPosition, yPosition, title;

- (id)initWithFrame:(CGRect)frame
{
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code
        [[NSBundle mainBundle] loadNibNamed:@"CMLocationItemView" owner:self options:nil];
        [self addSubview:self.view];
    }
    return self;
}

- (void)initializeWithField:(HHFieldModel *)f andHHManager:(SqLiteDatabaseManager*)db
{
    [self setField:f];
    [self setDbManager:db];
    
    for (id fieldID in f.children) {
        
        HHFieldModel* subfield = [f.children objectForKey:fieldID];
        
        if ([subfield.fieldTypeName isEqualToString:@"text"]) {

            if ([subfield.name isEqualToString:@"Label"])
            {
                [self setTitle:subfield.data];
            }
        }else if ([subfield.fieldTypeName isEqualToString:@"link_to_article"])
        {
            if ([subfield.name isEqualToString:@"Link To Article"])
            {
                [self setLinkToArticleNr:[NSNumber numberWithInt:[subfield.data intValue]]];
            }
        }
        else if ([subfield.fieldTypeName isEqualToString:@"resource_path"])
        {
            if ([subfield.name isEqualToString:@"Pin Icon"])
            {
                [self setLocationIcon:[subfield getImageForResource]];
            }
        }
        else if ([subfield.fieldTypeName isEqualToString:@"number"])
        {
            if ([subfield.name isEqualToString:@"Y Coordinate"])
            {
                [self setYPosition:[NSNumber numberWithInt:[subfield.data intValue]]];
                
            }else if([subfield.name isEqualToString:@"X Coordinate"])
            {
                [self setXPosition:[NSNumber numberWithInt:[subfield.data intValue]]];
            }
        }
    }
}

- (void) awakeFromNib
{
    [super awakeFromNib];
    
    // commenters report the next line causes infinite recursion, so removing it
    // [[NSBundle mainBundle] loadNibNamed:@"MyView" owner:self options:nil];
    [self addSubview:self.view];
}

- (void) dealloc
{
    [button release];
    [view release];
    [super dealloc];
}

@end
